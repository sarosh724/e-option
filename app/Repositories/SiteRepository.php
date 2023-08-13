<?php

namespace App\Repositories;

use App\Interfaces\SiteInterface;
use App\Models\Deposit;
use App\Models\UserAccount;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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

        $data = $data->orderBy("id", "desc")->get();

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
                $name = time().'_customer_'.$request->user_id.'_'.$request->amount.'_'.$photo->getClientOriginalName();
                $photo->move(public_path('uploads/payment_receipts'), $name);
                $deposit->photo = '/uploads/payment_receipts/'.$name;
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

        $data = $data->orderBy("id", "desc")->get();

        return $data;
    }

    public function storeWithdrawal(Request $request)
    {
        $res["type"] = "error";
        try {
            DB::beginTransaction();
            $withdraw = new Withdraw();
            $withdraw->user_id = $request->user_id;
            $withdraw->amount = $request->amount;
            $withdraw->user_account_id = $request->account;
            $withdraw->status = "pending";
            $withdraw->save();
            DB::commit();
            $res["type"] = "success";
            $res["message"] = "Withdraw Submitted Successfully";
        } catch (\Exception $e) {
            DB::rollBack();
            $res["message"] = "Internal Server Error";
        }

        return $res;
    }

    public function withdrawalAccountListing($id)
    {
        return UserAccount::where("user_id", $id)
            ->orderBy("id", "desc")
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
}
