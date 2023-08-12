<?php

namespace App\Repositories;

use App\Interfaces\DepositInterface;
use App\Models\Deposit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DepositRepository implements DepositInterface
{
    public function listing(Request $request)
    {
        $data = Deposit::join("users", "deposits.user_id", "users.id")
            ->join("payment_methods", "deposits.payment_method_id", "payment_methods.id");

        if (!empty($request->start_date) && !empty($request->end_date)) {
            $data = $data->whereBetween(DB::raw('DATE(deposits.created_at)'), [$request->start_date, $request->end_date]);
        }

        $data = $data->select(
            "users.name as user",
            "payment_methods.bank",
            "deposits.amount",
            "deposits.status",
            "deposits.id"
        )
            ->orderBy("deposits.id", "desc")
            ->get();

        return $data;
    }

    public function updateStatus(Request $request)
    {
        $res["type"] = "error";
        try {
            DB::beginTransaction();
            $deposit = Deposit::find($request->id);
            $deposit->status = $request->status;
            $deposit->save();
            DB::commit();
            $res["type"] = "success";
            $res["message"] = "Status Updated Successfully";
        } catch (\Exception $e) {
            DB::rollBack();
            $res["message"] = "Internal Server Error";
        }

        return $res;
    }
}
