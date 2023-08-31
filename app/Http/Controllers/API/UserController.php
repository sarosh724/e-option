<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Models\Referral;
use App\Models\Setting;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 *
 */
class UserController extends BaseController
{

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getUser(Request $request): JsonResponse
    {
        return $this->sendResponse($request->user(), 'User Details');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getReferralLink(Request $request): JsonResponse
    {
        return $this->sendResponse(
            [
                'ref_code' => base64_encode($request->user()->id),
                'referral_link' => url('register') . '?refcode=' . base64_encode($request->user()->id)
            ],
            'referral link and referral code'
        );
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getReferralDetails(Request $request): JsonResponse
    {
        $referralsCount = Referral::where("referred_by", $request->user()->id)
            ->count();
        $amountEarned = Setting::first()->referral_sign_up_amount * $referralsCount;

        return $this->sendResponse(['total_referrals' => $referralsCount, 'total_amount_earned' => $amountEarned],
            'referral details');
    }
}
