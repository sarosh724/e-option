<?php

namespace App\Http\Controllers\API;

use App\Interfaces\SiteInterface;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TradeController extends BaseController
{
    /**
     * @var SiteInterface
     */
    protected SiteInterface $siteInterface;

    public function __construct(SiteInterface $siteInterface)
    {
        $this->siteInterface = $siteInterface;
    }

    public function storeUserTrade(Request $request): JsonResponse
    {
        $validate = Validator::make($request->all(), [
            "amount_invested" => "required",
            "profit" => "required",
            "close_value" => "required",
            "latest" => "required",
            "label" => "required",
            "coin_id" => "required",
            "time_period" => "required"
        ]);

        if ($validate->fails()) {
            return $this->sendError('Validation Error.', $validate->errors());
        }

        $user = User::find($request->user()->id);
        $res = $this->siteInterface->storeUserTrade($request, $user);
        if ($res['success'] == 1) {
            return $this->sendResponse('', $res['message']);
        } else {
            return $this->sendError($res['message'], 'operation failed');
        }
    }

    public function getTradingHistory(Request $request): JsonResponse
    {
        $user = User::find($request->user()->id);
        $data = $this->siteInterface->getTradingHistory($request, $user, $request->coin_id);

        return $this->sendResponse($data, 'trading history');
    }
}
