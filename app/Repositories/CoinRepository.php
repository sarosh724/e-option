<?php

namespace App\Repositories;

use App\Interfaces\CoinInterface;
use App\Models\Coin;
use App\Models\Deposit;
use App\Models\UserAccount;
use App\Models\Withdraw;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CoinRepository implements CoinInterface
{
    public function coinListing($request, $id)
    {
        if($id){
        return Coin::find($id);
        }
        return Coin::all();
    }

    public function storeCoin(Request $request): array
    {
        $res["status"] = false;
        try {
            DB::beginTransaction();
            $coin = isset($request->id) ? Coin::find($request->id) : new Coin();
            $coin->name = $request->name;
            $coin->price = $request->price;
            $coin->min_value = $request->min_value;
            $coin->max_value = $request->max_value;
            $coin->profit_percentage = $request->profit_percentage;
            $coin->save();
            DB::commit();
            $res["status"] = true;
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return $res;
    }
}
