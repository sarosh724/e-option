<?php

namespace App\Repositories;

use App\Interfaces\WithdrawalInterface;
use App\Models\User;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawalRepository implements WithdrawalInterface
{
    public function listing(Request $request)
    {
        $data = Withdraw::join("users", "withdrawals.user_id", "users.id")
            ->join("user_withdrawal_accounts", "withdrawals.user_account_id", "user_withdrawal_accounts.id");

        if (!empty($request->start_date) && !empty($request->end_date)) {
            $data = $data->whereBetween(DB::raw('DATE(withdrawals.created_at)'), [$request->start_date, $request->end_date]);
        }

        $data = $data->select(
                "users.name as user",
                "user_withdrawal_accounts.bank",
                "user_withdrawal_accounts.account_name",
                "user_withdrawal_accounts.account_number",
                "withdrawals.amount",
                "withdrawals.status",
                "withdrawals.id"
            )
            ->orderBy("withdrawals.id", "desc")
            ->get();

        return $data;
    }

    public function updateStatus(Request $request)
    {
        $res["type"] = "error";
        try {
            DB::beginTransaction();
            $withdrawal = Withdraw::find($request->id);
            $withdrawal->status = $request->status;
            $withdrawal->save();
            DB::commit();
            if ($withdrawal->status == "approved") {
                $this->withdrawFromUserAccount($withdrawal);
            }
            $res["type"] = "success";
            $res["message"] = "Status Updated Successfully";
        } catch (\Exception $e) {
            DB::rollBack();
            $res["message"] = "Internal Server Error";
        }

        return $res;
    }

    public function withdrawFromUserAccount($data)
    {
        try {
            DB::beginTransaction();
            $user = User::find($data->user_id);
            $user->account_balance -= $data->amount;
            $user->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }
    }
}
