<?php

namespace App\Http\Controllers\API;

use App\Interfaces\PaymentMethodInterface;
use App\Interfaces\SettingInterface;
use App\Interfaces\SiteInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 *
 */
class AccountController extends BaseController
{
    /**
     * @var SiteInterface
     */
    protected SiteInterface $siteInterface;

    /**
     * @var SettingInterface
     */
    protected SettingInterface $settingInterface;

    /**
     * @var PaymentMethodInterface
     */
    protected PaymentMethodInterface $paymentMethodInterface;

    /**
     * @param SettingInterface $settingInterface
     * @param SiteInterface $siteInterface
     * @param PaymentMethodInterface $paymentMethodInterface
     */
    public function __construct(SettingInterface $settingInterface, SiteInterface $siteInterface, PaymentMethodInterface $paymentMethodInterface)
    {
        $this->settingInterface = $settingInterface;
        $this->siteInterface = $siteInterface;
        $this->paymentMethodInterface = $paymentMethodInterface;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function getPaymentMethod(Request $request): JsonResponse
    {
        $data = $this->paymentMethodInterface->paymentMethodListing();

        return $this->sendResponse($data, 'Payment Method Listing');
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function getWithdrawalAccount(Request $request, $id = null): JsonResponse
    {
        $userId = $request->user()->id;
        $data = $this->siteInterface->withdrawalAccountListing($userId, $id);

        return $this->sendResponse($data, 'Withdrawal Account Listing');
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function storeWithdrawalAccount(Request $request): JsonResponse
    {
        $validator = Validator::make($request->all(), [
            "user_id" => "required",
            "bank" => "required",
            "account_name" => "required",
            "account_number" => "required",
            "phone" => "required"
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $res = $this->siteInterface->storeWithdrawalAccount($request);

        if ($res['type'] == 'success') {
            return $this->sendResponse('', $res['message']);
        } else {
            return $this->sendError($res['message'], '');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse|void
     */
    public function deposit(Request $request, $id  = null)
    {
        if ($request->post()) {
            $validator = Validator::make($request->all(), [
                "user_id" => "required",
                "amount" => "required",
                "payment_method" => "required",
                "photo" => "required"
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            $res = $this->siteInterface->storeDeposit($request);

            if ($res['type'] == 'success') {
                return $this->sendResponse('', $res['message']);
            } else {
                return $this->sendError($res['message'], '');
            }
        }

        if ($request->isMethod('get')) {
            $userId = $request->user()->id;
            $data = $this->siteInterface->depositListing($id, $userId);

            return $this->sendResponse($data, 'Deposit History Listing');
        }
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse|void
     */
    public function withdrawal(Request $request, $id = null)
    {
        if ($request->post()) {
            $validator = Validator::make($request->all(), [
                "user_id" => "required",
                "amount" => "required",
                "account" => "required"
            ]);

            if ($validator->fails()) {
                return $this->sendError('Validation Error.', $validator->errors());
            }

            if ($request->amount > $request->user()->account_balance) {
                return $this->sendError("warning", "Sorry, Your account balance is less than the withdrawal amount");
            }

            $setting = $this->settingInterface->show();
            if ($request->amount < $setting->withdraw_limit) {
                return $this->sendError("warning", "Sorry, Minimum Withdraw limit is ".$setting->withdraw_limit."$");
            }

            $res = $this->siteInterface->storeWithdrawal($request);

            if ($res['type'] == 'success') {
                return $this->sendResponse('', $res['message']);
            } else {
                return $this->sendError($res['message'], '');
            }
        }

        if ($request->isMethod('get')) {
            $userId = $request->user()->id;
            $data = $this->siteInterface->withdrawalListing($id, $userId);

            return $this->sendResponse($data, 'Withdrawal History Listing');
        }
    }

    public function changeUserAccount(Request $request): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            "type" => "required"
        ]);

        if ($validate->fails()) {
            return $this->sendError('Validation Error.', $validate->errors());
        }

        $user = User::find($request->user()->id);
        $res = $this->siteInterface->changeUserAccount($request, $user);
        if($res['success']){
            return $this->sendResponse([], 'Account Changed Successfully');
        }
        else {
            return $this->sendError($res['message'], 'something went wrong');
        }
    }
}
