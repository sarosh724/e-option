<?php

namespace App\Repositories;

use App\Interfaces\CoinInterface;
use App\Models\Coin;
use App\Models\CoinPricePump;
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
            $coin->buy_profit = $request->buy_profit;
            $coin->sell_profit = $request->sell_profit;
            $coin->save();
            DB::commit();
            $res["status"] = true;
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return $res;
    }

    public function storeCoinPump(Request $request): array
    {
        $res["status"] = false;
        try {
            DB::beginTransaction();

            # deleting previous pump(s) created
            $coinPump = CoinPricePump::where('coin_id', $request->coin_id)->delete();

                $coin = new CoinPricePump();
                $coin->coin_id = $request->coin_id;
                $coin->pump_type = $request->pump_type;
                $coin->start_date_time = $request->start_date_time;
                $coin->end_date_time = $request->end_date_time;
                $coin->save();

            DB::commit();
            $res["status"] = true;
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
        }

        return $res;
    }
}
