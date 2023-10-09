<?php

namespace App\Http\Controllers;

use App\Interfaces\DashboardInterface;
use App\Interfaces\DepositInterface;
use App\Interfaces\UserInterface;
use App\Interfaces\WithdrawalInterface;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    protected WithdrawalInterface $withdrawalInterface;
    protected DepositInterface $depositInterface;
    protected UserInterface $userInterface;
    protected DashboardInterface $dashboardInterface;

    public function __construct(
        WithdrawalInterface $withdrawalInterface,
        DepositInterface $depositInterface,
        UserInterface $userInterface,
        DashboardInterface $dashboardInterface
    ) {
        $this->withdrawalInterface = $withdrawalInterface;
        $this->depositInterface = $depositInterface;
        $this->userInterface = $userInterface;
        $this->dashboardInterface = $dashboardInterface;
    }

    public function index()
    {
        return redirect()->route('admin-dashboard');
    }

    public function dashboard()
    {
        $data['users'] = $this->dashboardInterface->totalUsers();
        $data['pending_deposits'] = $this->dashboardInterface->pendingDeposits();
        $data['completed_deposits'] = $this->dashboardInterface->completedDeposits();
        $data['completed_withdrawals'] = $this->dashboardInterface->completedWithdrawals();

        return view('admin.dashboard.dashboard', compact(['data']));
    }

    public function profile(Request $request)
    {
        if ($request->post()) {
            $validate = Validator::make($request->all(), [
                "name" => "required",
                "email" => "required"
            ]);

            if ($validate->fails()) {
                return redirect(url('admin/profile'))->withErrors($validate);
            }

            $res = $this->userInterface->update($request);

            return redirect()->back()->with($res['type'], $res['message']);
        }

        return view("admin.dashboard.profile");
    }

    public function getUsers(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->userInterface->listing();

            return DataTables::of($data)
                ->addColumn('name', function ($data) {
                    return $data->name;
                })
                ->addColumn('email', function ($data) {
                    return $data->email;
                })
                ->addColumn('balance', function ($data) {
                    return $data->account_balance;
                })
                ->addColumn('actions', function ($data) {
                    if($data->is_restricted){
                        $restricted = 0;
                        $icon = 'fa fa-unlock';
                        $btnClass = 'btn-danger';
                        $btnText = 'Unrestrict';
                    }
                    else{
                        $restricted = 1;
                        $icon = 'fa-lock';
                        $btnClass = 'btn-primary';
                        $btnText = 'Restrict';
                    }
                    $html = "<a href='javascript:void(0);' data-restricted=$restricted data-id=$data->id class='btn btn-sm restrict $btnClass'><i class='fas $icon mr-1'></i>$btnText</a>
                            <a href='javascript:void(0);'  data-id=$data->id class='btn btn-sm btn-outline-danger delete'><i class='fas fa-trash mr-1'></i>Delete</a>";

                    return $html;
                })
                ->rawColumns(['actions'])
                ->make(true);
        }

        return view('admin.users.listing');
    }

    public function getDeposits(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->depositInterface->listing($request);

            return DataTables::of($data)
                ->addColumn('user', function ($data) {
                    return $data->user;
                })
                ->addColumn('bank', function ($data) {
                    return $data->bank;
                })
                ->addColumn('amount', function ($data) {
                    return $data->amount;
                })
                ->addColumn('photo', function ($data) {
                    $html = "N/A";
                    if (!empty($data->photo)) {
                        $html = '<a href="'.asset(''.$data->photo.'').'" target="_blank" class="ml-2">click here</a>';
                    }

                    return $html;
                })
                ->addColumn('status', function ($data) {
                    return statusDropdown("deposit", $data->status, $data->id);
                })
                ->rawColumns(['status', 'photo'])
                ->make(true);
        }

        $start_date = date('Y-m-d',strtotime('-1 year'));
        $end_date = date('Y-m-d', strtotime('+1 year'));

        return view('admin.deposits.listing', compact(['start_date', 'end_date']));
    }

    public function changeDepositStatus(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "id" => "required",
            "status" => "required"
        ]);

        if ($validate->fails()) {
            $res["type"] = "error";
            $res["message"] = "Validation Error";

            return response()->json($res);
        }

        $res = $this->depositInterface->updateStatus($request);

        return response()->json($res);
    }

    public function getWithdrawals(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->withdrawalInterface->listing($request);

            return DataTables::of($data)
                ->addColumn('user', function ($data) {
                    return $data->user;
                })
                ->addColumn('bank', function ($data) {
                    return $data->bank;
                })
                ->addColumn('account_name', function ($data) {
                    return $data->account_name;
                })
                ->addColumn('account_number', function ($data) {
                    return $data->account_number;
                })
                ->addColumn('amount', function ($data) {
                    return $data->amount;
                })
                ->addColumn('status', function ($data) {
                    return statusDropdown("withdrawal", $data->status, $data->id);
                })
                ->rawColumns(['status'])
                ->make(true);
        }

        $start_date = date('Y-m-d',strtotime('-1 year'));
        $end_date = date('Y-m-d', strtotime('+1 year'));

        return view('admin.withdrawals.listing', compact(['start_date', 'end_date']));
    }

    public function changeWithdrawalStatus(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "id" => "required",
            "status" => "required"
        ]);

        if ($validate->fails()) {
            $res["type"] = "error";
            $res["message"] = "Validation Error";

            return response()->json($res);
        }

        $res = $this->withdrawalInterface->updateStatus($request);

        return response()->json($res);
    }

    public function getCoins()
    {
        return view('admin.coins.listing');
    }

    public function getPaymentMethods()
    {
        return view('admin.payment-methods.listing');
    }

    public function restrictUser(Request $request){
        $response['success'] = false;
        if(User::where('id', $request->user_id)->update(['is_restricted' => $request->is_restricted])){
            if($request->is_restricted){
                $user = User::find($request->user_id);
                send_email($user->email, 'Account Restricted', ['user' => $user], 'restricted');
            }
            $response['success'] = true;
            $response['message'] = 'Operation Successful';
        }
        else{
            $response['message'] = 'Something Went Wrong';
        }

        return response()->json($response);
    }

    public function deleteUser($id){
        $response['success'] = false;
        if(User::where('id', $id)->delete()){

            $response['success'] = true;
            $response['message'] = 'Account Deleted';
        }
        else{
            $response['message'] = 'Something Went Wrong';
        }

        return response()->json($response);
    }
}
