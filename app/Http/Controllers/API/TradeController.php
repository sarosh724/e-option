<?php

namespace App\Http\Controllers\API;

use App\Interfaces\SiteInterface;
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

    public function storeUserTrade(Request $request)
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

        $res = $this->siteInterface->storeUserTrade($request);
        if ($res['success'] == 1) {
            return $this->sendResponse('', $res['message']);
        } else {
            return $this->sendError($res['message'], 'operation failed');
        }
    }

    public function getTradingHistory(Request $request, $id, $coinId = null)
    {
            $data = $this->siteInterface->getTradingHistory($id, $coinId);

            return $this->sendResponse($data, 'trading history');
    }
}
