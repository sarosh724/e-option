<?php

namespace App\Http\Controllers;

use App\Interfaces\SiteInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SiteController extends Controller
{
    protected SiteInterface $siteInterface;

    public function __construct(SiteInterface $siteInterface)
    {
        $this->siteInterface = $siteInterface;
    }

    public function index()
    {
        return view('site.pages.home');
    }

    public function trading()
    {
        return view('site.pages.trading');
    }

    public function deposit(Request $request)
    {
        if ($request->post()) {
            $validate = Validator::make($request->all(), [
                "user_id" => "required",
                "amount" => "required",
                "payment_method" => "required"
            ]);

            if ($validate->fails()) {
                return redirect(url('deposit'))->withErrors($validate);
            }

            $res = $this->siteInterface->storeDeposit($request);

            return redirect(url('deposit'))->with($res['type'], $res['message']);
        }

        if ($request->ajax()) {
            $data = $this->siteInterface->depositListing(null, 1);
            return DataTables::of($data)
                ->addColumn('date', function ($data) {
                    return $data->created_at;
                })
                ->addColumn('amount', function ($data) {
                    return $data->amount;
                })
                ->addColumn('status', function ($data) {
                    return $data->status;
                })
                ->make(true);
        }

        return view('site.pages.deposit');
    }

    public function withdrawal(Request $request)
    {
        if ($request->post()) {
            $validate = Validator::make($request->all(), [
                "user_id" => "required",
                "amount" => "required",
                "account" => "required"
            ]);

            if ($validate->fails()) {
                return redirect(url('withdrawal'))->withErrors($validate);
            }

            $res = $this->siteInterface->storeWithdrawal($request);

            return redirect(url('withdrawal'))->with($res['type'], $res['message']);
        }

        if ($request->ajax()) {
            $data = $this->siteInterface->withdrawalListing(null, 1);
            return DataTables::of($data)
                ->addColumn('date', function ($data) {
                    return $data->created_at;
                })
                ->addColumn('amount', function ($data) {
                    return $data->amount;
                })
                ->addColumn('status', function ($data) {
                    return $data->status;
                })
                ->make(true);
        }

        $accounts = $this->siteInterface->withdrawalAccountListing(1);

        return view('site.pages.withdrawal', compact(['accounts']));
    }

    public function settings()
    {
        return view('site.pages.settings');
    }

    public function about()
    {
        return view('site.pages.about');
    }

    public function getWithdrawalAccounts(Request $request)
    {
        if ($request->ajax()) {
            $data = $this->siteInterface->withdrawalAccountListing(1);
            return DataTables::of($data)
                ->addColumn('bank', function ($data) {
                    return $data->payment_method_id;
                })
                ->addColumn('account_name', function ($data) {
                    return $data->account_name;
                })
                ->addColumn('account_number', function ($data) {
                    return $data->account_number;
                })
                ->addColumn('phone', function ($data) {
                    return $data->phone;
                })
                ->make(true);
        }
    }

    public function storeWithdrawalAccount(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "user_id" => "required",
            "payment_method" => "required",
            "account_name" => "required",
            "account_number" => "required",
            "phone" => "required"
        ]);

        if ($validate->fails()) {
            return redirect(url('settings'))->withErrors($validate);
        }

        $res = $this->siteInterface->storeWithdrawalAccount($request);

        return redirect(url('settings'))->with($res['type'], $res['message']);
    }
}
