<?php

namespace App\Http\Controllers\API;

use App\Interfaces\CoinInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 *
 */
class CoinController extends BaseController
{
    /**
     * @var CoinInterface
     */
    protected CoinInterface $coinInterface;

    /**
     * @param CoinInterface $coinInterface
     */
    public function __construct(CoinInterface $coinInterface)
    {
        $this->coinInterface = $coinInterface;
    }

    /**
     * @param Request $request
     * @param $id
     * @return JsonResponse
     */
    public function getCoin(Request $request, $id = null): JsonResponse
    {
        $data = $this->coinInterface->coinListing($request, $id);

        return $this->sendResponse($data, 'Coin Listing');
    }
}
