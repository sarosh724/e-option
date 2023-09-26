<?php

namespace App\Http\Controllers;

use App\Interfaces\PaymentMethodInterface;
use App\Interfaces\SettingInterface;
use App\Interfaces\SiteInterface;
use App\Interfaces\WithdrawalInterface;
use App\Models\PaymentMethod;
use App\Models\Referral;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Yajra\DataTables\DataTables;

class SiteController extends Controller
{
    protected SiteInterface $siteInterface;
    protected PaymentMethodInterface $paymentMethodInterface;
    protected SettingInterface $settingInterface;
    protected WithdrawalInterface $withdrawalInterface;

    public function __construct(
        SiteInterface $siteInterface,
        PaymentMethodInterface $paymentMethodInterface,
        SettingInterface $settingInterface,
        WithdrawalInterface $withdrawalInterface
    ) {
        $this->siteInterface = $siteInterface;
        $this->paymentMethodInterface = $paymentMethodInterface;
        $this->settingInterface = $settingInterface;
        $this->withdrawalInterface = $withdrawalInterface;
    }

    public function index()
    {
        if (Auth::check()) {
            return redirect()->intended('/dashboard');
        }

        return view('user-site.home');
    }

    public function dashboard()
    {
        $data['count_deposits'] = auth()->user()->countDeposit();
        $data['count_withdrawals'] = auth()->user()->countWithdraw();
        $data['count_trades'] = auth()->user()->countTrades();
        $data['count_referrals'] = auth()->user()->countReferral();

        return view('user-site.trade.dashboard', compact(['data']));
    }

    public function trading()
    {
        return view('user-site.trade.trading');
    }

    public function deposit(Request $request)
    {
        if ($request->post()) {
            $validate = Validator::make($request->all(), [
                "user_id" => "required",
                "amount" => "required",
                "payment_method" => "required",
                "photo" => "required"
            ]);

            if ($validate->fails()) {
                return redirect(url('deposit'))->withErrors($validate);
            }

            $res = $this->siteInterface->storeDeposit($request);

            return redirect(url('deposit'))->with($res['type'], $res['message']);
        }

        if ($request->ajax()) {
            $id = auth()->id();

            if (\auth()->user()->is_demo_account) {
                $data = [];
            } else {
                $data = $this->siteInterface->depositListing(null, $id);
            }

            return DataTables::of($data)
                ->addColumn('date', function ($data) {
                    return showDate($data->created_at);
                })
                ->addColumn('amount', function ($data) {
                    return $data->amount;
                })
                ->addColumn('status', function ($data) {
                    return statusBadge($data->status);
                })
                ->rawColumns(['status'])
                ->make(true);
        }

        $payment_methods = $this->paymentMethodInterface->paymentMethodListing(true);

        return view('user-site.trade.deposit', compact(['payment_methods']));
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

            if ($request->amount > auth()->user()->account_balance) {
                return back()->with("warning", "Sorry, Your account balance is less than the withdrawal amount");
            }

            $setting = $this->settingInterface->show();
            if ($request->amount < $setting->withdraw_limit) {
                return back()->with("warning", "Sorry, Minimum Withdraw limit is ".$setting->withdraw_limit."$");
            }
            $res = $this->withdrawalInterface->storeWithdrawal($request);

            return redirect(url('withdrawal'))->with($res['type'], $res['message']);
        }

        if ($request->ajax()) {
            $id = auth()->id();

            if (\auth()->user()->is_demo_account) {
                $data = [];
            } else {
                $data = $this->siteInterface->withdrawalListing(null, $id);
            }

            return DataTables::of($data)
                ->addColumn('date', function ($data) {
                    return showDate($data->created_at);
                })
                ->addColumn('amount', function ($data) {
                    return $data->amount;
                })
                ->addColumn('status', function ($data) {
                    return statusBadge($data->status);
                })
                ->rawColumns(['status'])
                ->make(true);
        }

        $accounts = $this->siteInterface->withdrawalAccountListing(auth()->id(), $id=null);

        return view('user-site.trade.withdrawal', compact(['accounts']));
    }

    public function transactions()
    {
        return view('user-site.trade.transactions');
    }

    public function tradeHistory()
    {
        return view('user-site.trade.trades');
    }

    public function referral()
    {
        $referrals = Referral::where("referred_by", auth()->user()->id)->count();
        $referrer_amount = Setting::select("referral_sign_up_amount")->pluck("referral_sign_up_amount")->first();

        return view('user-site.trade.referral', compact(['referrals', 'referrer_amount']));
    }

    public function withdrawalAccount()
    {
        return view('user-site.trade.withdrawal-account');
    }

    public function account()
    {
        return view('user-site.trade.account');
    }

    public function settings()
    {
        return view('site.pages.settings');
    }

    public function about()
    {
        return view('user-site.about');
    }

    public function market(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $recentTrades = $this->siteInterface->getTradingHistory($request, $user);
//        dd($recentTrades);

        return view('user-site.trade.market', compact(['recentTrades']));
    }

    public function getWithdrawalAccounts(Request $request, $id = null)
    {
        if ($request->ajax()) {
            $userId  = auth()->id();
            $data = $this->siteInterface->withdrawalAccountListing($userId, $id);
            return DataTables::of($data)
                ->addColumn('bank', function ($data) {
                    return $data->bank;
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
            "bank" => "required",
            "account_name" => "required",
            "account_number" => "required",
            "phone" => "required"
        ]);

        if ($validate->fails()) {
            return redirect()->back()->withErrors($validate);
        }

        $res = $this->siteInterface->storeWithdrawalAccount($request);

        return redirect()->back()->with($res['type'], $res['message']);
    }

    public function getPaymentMethodDetail($id)
    {
        return PaymentMethod::find($id);
    }

    public function trade(Request $request, $tab = null)
    {
        if ($request->ajax()) {
            switch ($tab) {
                case "market":
                    return view("user-site.trade.market");
                case "deposit":
                    $payment_methods = $this->paymentMethodInterface->paymentMethodListing(true);

                    return view("user-site.trade.deposit", compact(['payment_methods']));
                case "withdrawal":
                    $accounts = $this->siteInterface->withdrawalAccountListing(auth()->id(), $id=null);

                    return view("user-site.trade.withdrawal", compact(['accounts']));
                case "transactions":
                    return view("user-site.trade.transactions");
                case "trades":
                    return view("user-site.trade.trades");
                case "account":
                    return view("user-site.trade.account");
                case "referral":
                    $referrals = Referral::where("referred_by", auth()->user()->id)->count();
                    $referrer_amount = Setting::select("referral_sign_up_amount")->pluck("referral_sign_up_amount")->first();

                    return view("user-site.trade.referral", compact(['referrals', 'referrer_amount']));
            }
        }

        return view('user-site.trade.index');
    }

    public function storeUserTrade(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "amount_invested" => "required",
            "profit" => "required",
            "close_value" => "required",
            "latest" => "required",
            "label" => "required",
            "coin_id" => "required",
            "time_period" => "required"
        ]);

        if ($validate->fails()) {
            return response()->json([
                "success" => 0,
                "message" => "Validation Error"
            ]);
        }

        $user = User::find(auth()->user()->id);
        $res = $this->siteInterface->storeUserTrade($request, $user);

        return response()->json($res);
    }

    public function getTradingHistory(Request $request, $id, $coinId = null)
    {
        if ($request->ajax()) {
            $user = User::find(auth()->user()->id);
            $data = $this->siteInterface->getTradingHistory($request, $user, $coinId);
            return DataTables::of($data)
                ->addColumn('coin', function ($data) {
                    return $data->coin_name;
                })
                ->addColumn('amount_invested', function ($data) {
                    return '$'.sprintf("%0.2f", @$data->amount_invested);
                })
                ->addColumn('starting_price', function ($data) {
                    return '$'.@$data->starting_price;
                })
                ->addColumn('closing_price', function ($data) {
                    return '$'.@$data->closing_price;
                })
                ->addColumn('time_period', function ($data) {
                    return $data->time_period;
                })
                ->addColumn('type', function ($data) {
                    return statusBadge($data->label);
                })
                ->addColumn('result', function ($data) {
                    $class = "btn-danger";
                    $icon = "fa-minus";
                    $txt = '$'.sprintf("%0.2f", $data->amount_invested) . " " . $data->result;

                    if ($data->result == "Profit") {
                        $class = "btn-success";
                        $icon = "fa-plus";
                        $txt = '$'.sprintf("%0.2f", $data->profit) . " " . $data->result;
                    }

                    return '<a class="btn btn-sm '.$class.'"><i class="far '.$icon.' text-white mr-1" style="font-size: 12px;"></i>'.$txt.'</a>';
                })
                ->rawColumns(['result', 'type'])
                ->make(true);
        }
    }

    public function getAccountBalance(Request $request)
    {
        $user = User::where('id', auth()->user()->id)
            ->select(
                "is_demo_account",
                "account_balance",
                "demo_account_balance"
            )
            ->first();

        return response()->json(['success' => 1, 'data' => $user]);
    }

    public function changeUserAccount(Request $request)
    {
        $validate = Validator::make($request->all(), [
            "type" => "required"
        ]);

        if ($validate->fails()) {
            return response()->json([
                "success" => 0,
                "message" => "Validation Error"
            ]);
        }

        $user = User::find(auth()->user()->id);
        $res = $this->siteInterface->changeUserAccount($request, $user);

        return response()->json($res);
    }

    public function changePassword(Request $request){
        $validator = Validator::make($request->all(), [
            'password' => 'required | max:12 | min:8',
        ]);

        if ($validator->fails()) {
            return redirect(url('account'))->withErrors($validator->errors());
        }

        $response = $this->siteInterface->changePassword($request);

        return redirect('account')->with($response['type'], $response['message']);
    }

    public function getWithdrawalAccount(Request $request){

        if ($request->ajax()) {
            $data = $this->siteInterface->withdrawalAccountListing(auth()->user()->id, null);

            return DataTables::of($data)
                ->addColumn('bank', function ($data) {
                    return $data->bank;
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
}
