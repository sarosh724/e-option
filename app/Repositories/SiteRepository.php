<?php

namespace App\Repositories;

use App\Interfaces\SiteInterface;
use App\Models\Deposit;
use App\Models\Trade;
use App\Models\User;
use App\Models\UserAccount;
use App\Models\Withdraw;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SiteRepository implements SiteInterface
{
    public function depositListing($id = null, $user_id = null)
    {
        $data = Deposit::with("user", "payment_method");

        if (!empty($user_id)) {
            $data = $data->where("user_id", $user_id);
        }

        if (!empty($id)) {
            $data = $data->where("id", $id);
        }

        $data = $data->orderBy("id", "desc")
            ->get();

        return $data;
    }

    public function storeDeposit(Request $request)
    {
        $res["type"] = "error";
        try {
            DB::beginTransaction();
            $deposit = new Deposit();
            $deposit->user_id = $request->user_id;
            $deposit->amount = $request->amount;
            $deposit->payment_method_id = $request->payment_method;
            $deposit->status = "pending";
            if (isset($request->photo)) {
                $photo = $request->file('photo');
                $name = time(
                    ) . '_customer_' . $request->user_id . '_' . $request->amount . '_' . $photo->getClientOriginalName(
                    );
                $photo->move(public_path('uploads/payment_receipts'), $name);
                $deposit->photo = '/uploads/payment_receipts/' . $name;
            }
            $deposit->save();
            DB::commit();
            $res["type"] = "success";
            $res["message"] = "Deposit Submitted Successfully";
        } catch (\Exception $e) {
            DB::rollBack();
            $res["message"] = "Internal Server Error";
        }

        return $res;
    }

    public function withdrawalListing($id = null, $user_id = null)
    {
        $data = Withdraw::with("user");

        if (!empty($user_id)) {
            $data = $data->where("user_id", $user_id);
        }

        if (!empty($id)) {
            $data = $data->where("id", $id);
        }

        $data = $data->orderBy("id", "desc")
            ->get();

        return $data;
    }


    public function withdrawalAccountListing($userId, $id)
    {
        $data = UserAccount::where("user_id", $userId);
        if ($id) {
            $data = $data->where('id', $id);
        }

        return $data->orderBy("id", "desc")
            ->get();
    }

    public function storeWithdrawalAccount(Request $request)
    {
        $res["type"] = "error";
        try {
            $check = UserAccount::where("user_id", $request->user_id)
                ->where("bank", $request->bank)
                ->where("account_number", $request->account_number)
                ->first();
            if ($check) {
                $res["type"] = "warning";
                $res["message"] = "Account Already exists! Please create new one";

                return $res;
            }
            DB::beginTransaction();
            $account = new UserAccount();
            $account->user_id = $request->user_id;
            $account->bank = $request->bank;
            $account->account_name = $request->account_name;
            $account->account_number = $request->account_number;
            $account->phone = $request->phone;
            $account->save();
            DB::commit();
            $res["type"] = "success";
            $res["message"] = "Account Saved Successfully";
        } catch (\Exception $e) {
            DB::rollBack();
            $res["message"] = "Internal Server Error";
        }

        return $res;
    }

    public function storeUserTrade(Request $request, $user)
    {
        $res["success"] = 0;
        $result = '';
        try {
            DB::beginTransaction();
            if ($request->label == "buy") {
                if ($request->latest > $request->close_value) {
                    if ($user->is_demo_account) {
                        $user->demo_account_balance += $request->profit;
                        $res['balance'] = $user->demo_account_balance;
                    } else {
                        $user->account_balance += $request->profit;
                        $res['balance'] = $user->account_balance;
                    }
                    $res['success'] = 1;
                    $res['message'] = 'Congratulations, You earned profit of $' . $request->profit;
                    $result = 'Profit';
                } else {
//                    if ($user->is_demo_account) {
//                        $user->demo_account_balance -= $request->amount_invested;
//                        $res['balance'] = $user->demo_account_balance;
//                    } else {
//                        $user->account_balance -= $request->amount_invested;
//                        $res['balance'] = $user->account_balance;
//                    }
                    $res['success'] = 1;
                    $res['message'] = 'Sorry, You Lost $' . $request->amount_invested;
                    $result = 'Lose';
                }
            }

            if ($request->label == "sell") {
                if ($request->latest < $request->close_value) {
                    if ($user->is_demo_account) {
                        $user->demo_account_balance += $request->profit;
                        $res['balance'] = $user->demo_account_balance;
                    } else {
                        $user->account_balance += $request->profit;
                        $res['balance'] = $user->account_balance;
                    }
                    $res['success'] = 1;
                    $res['message'] = 'Congratulations, You earned profit of $' . $request->profit;
                    $result = 'Profit';
                } else {
//                    if ($user->is_demo_account) {
//                        $user->demo_account_balance -= $request->amount_invested;
//                        $res['balance'] = $user->demo_account_balance;
//                    } else {
//                        $user->account_balance -= $request->amount_invested;
//                        $res['balance'] = $user->account_balance;
//                    }
                    $res['success'] = 1;
                    $res['message'] = 'Sorry, You Lost $' . $request->amount_invested;
                    $result = 'Lose';
                }
            }
            $user->save();

            $trade = new Trade();
            $trade->user_id = $user->id;
            $trade->coin_id = $request->coin_id;
            $trade->label = $request->label;
            $trade->amount_invested = $request->amount_invested;
            $trade->starting_price = $request->close_value;
            $trade->closing_price = $request->latest;
            $trade->account_type = ($user->is_demo_account) ? "demo" : "live";
            $trade->profit = $request->profit;
            $trade->time_period = $request->time_period;
            $trade->result = $result;
            $trade->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            $res["message"] = "Internal Server Error";
        }

        return $res;
    }

    public function getTradingHistory($request, $user, $coin_id = null, $filter = null)
    {
        $type = "live";
        $data = Trade::join("coins", "trades.coin_id", "coins.id");

        if (isset($coin_id)) {
            $data = $data->where("trades.coin_id", $coin_id);
        }

        if (isset($filter)) {
            switch ($filter) {
                case "today":
                    $data = $data->whereDate("trades.created_at", Carbon::today());
                    break;
                default:
                    break;
            }
        }

        if ($user->is_demo_account) {
            $type = "demo";
        }

        $data = $data->where("trades.user_id", $user->id)
            ->where("account_type", $type);

        return $data->select(
            "trades.*",
            "coins.name as coin_name"
        )->orderBy("trades.id", "desc")->get();
    }

    public function changeUserAccount(Request $request, $user)
    {
        $res['success'] = 0;
        try {
            DB::beginTransaction();
            User::where("id", $user->id)
                ->update(["is_demo_account" => ($request->type == "demo") ? 1 : 0]);
            DB::commit();
            $res['success'] = 1;
        } catch (\Exception $e) {
            DB::rollBack();
            $res['message'] = "Internal Server Error";
        }

        return $res;
    }

    public function changePassword($request)
    {
        $response['type'] = 'error';
        try {
            DB::beginTransaction();
            User::where('id', $request->user_id)->update(['password' => password_hash($request->password, PASSWORD_DEFAULT)]);
            DB::commit();
            $response['type'] = 'success';
            $response['message'] = "Password Changed";
        } catch (\Exception $e) {
            DB::rollBack();
            Log::debug($e->getMessage());
            $response['message'] = "Something went wrong, please try again";
        }

        return $response;
    }
}
