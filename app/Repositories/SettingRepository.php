<?php

namespace App\Repositories;

use App\Interfaces\SettingInterface;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SettingRepository implements SettingInterface
{
    public function show()
    {
        return Setting::first();
    }

    public function store(Request $request)
    {
        $res["type"] = "error";
        try {
            DB::beginTransaction();
            $setting = isset($request->id) ? Setting::find($request->id) : new Setting();
            $setting->withdraw_limit = $request->withdraw_limit;
            $setting->referral_sign_up_amount = $request->referral_sign_up_amount;
            $setting->demo_account_balance = $request->demo_account_balance;
            $setting->save();
            DB::commit();
            $res["type"] = "success";
            $res["message"] = "Settings saved successfully";
        } catch (\Exception $e) {
            DB::rollBack();
            $res["message"] = "Internal Server Error";
        }

        return $res;
    }

    public function getDemoAmount()
    {
        return Setting::select("demo_account_balance")->pluck("demo_account_balance")->first();
    }
}
