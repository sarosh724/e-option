<?php

namespace App\Http\Controllers;

use App\Interfaces\DepositInterface;
use App\Interfaces\WithdrawalInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class AdminController extends Controller
{
    protected WithdrawalInterface $withdrawalInterface;
    protected DepositInterface $depositInterface;

    public function __construct(WithdrawalInterface $withdrawalInterface, DepositInterface $depositInterface)
    {
        $this->withdrawalInterface = $withdrawalInterface;
        $this->depositInterface = $depositInterface;
    }

    public function index()
    {
        return redirect()->route('admin-dashboard');
    }

    public function dashboard()
    {
        return view('admin.dashboard.dashboard');
    }

    public function getUsers()
    {
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
                ->addColumn('status', function ($data) {
                    return statusDropdown("deposit", $data->status, $data->id);
                })
                ->rawColumns(['status'])
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
}
