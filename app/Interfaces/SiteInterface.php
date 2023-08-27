<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface SiteInterface
{
    public function depositListing($id = null, $user_id = null);
    public function storeDeposit(Request $request);
    public function withdrawalAccountListing($userId, $id);
    public function storeWithdrawalAccount(Request $request);
    public function withdrawalListing($id = null, $user_id = null);
    public function storeWithdrawal(Request $request);
    public function storeUserTrade(Request $request);
    public function getTradingHistory($user_id, $coin_id = null);
}
