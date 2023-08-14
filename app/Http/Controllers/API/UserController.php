<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
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
}
