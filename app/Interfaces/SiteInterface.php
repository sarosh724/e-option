<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

/**
 *
 */
interface SiteInterface
{
    /**
     * @param $id
     * @param $user_id
     * @return mixed
     */
    public function depositListing($id = null, $user_id = null);

    /**
     * @param Request $request
     * @return mixed
     */
    public function storeDeposit(Request $request);

    /**
     * @param $userId
     * @param $id
     * @return mixed
     */
    public function withdrawalAccountListing($userId, $id);

    /**
     * @param Request $request
     * @return mixed
     */
    public function storeWithdrawalAccount(Request $request);

    /**
     * @param $id
     * @param $user_id
     * @return mixed
     */
    public function withdrawalListing($id = null, $user_id = null);

    /**
     * @param Request $request
     * @return mixed
     */
    public function storeWithdrawal(Request $request);

    /**
     * @param Request $request
     * @return mixed
     */
    public function storeUserTrade(Request $request, $user);

    /**
     * @param $request
     * @param $user_id
     * @param $coin_id
     * @return mixed
     */
    public function getTradingHistory($request, $user, $coin_id = null, $filter = null);

    /**
     * @param Request $request
     * @return mixed
     */
    public function changeUserAccount(Request $request, $user);

    public function changePassword(Request $request);

}
