<?php

use App\Http\Controllers\API\AccountController;
use App\Http\Controllers\API\CoinController;
use App\Http\Controllers\API\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::controller(AuthController::class)->group(function(){
    Route::post('register/{refCode?}', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('get-user', [UserController::class, 'getUser']);
    Route::get('get-referral-link', [UserController::class, 'getReferralLink']);
    Route::get('get-referral-detail', [UserController::class, 'getReferralDetails']);
    Route::get('get-withdrawal-account', [AccountController::class, 'getWithdrawalAccount']);
    Route::get('get-withdrawal-account/{id}', [AccountController::class, 'getWithdrawalAccount']);
    Route::post('store-withdrawal-account', [AccountController::class, 'storeWithdrawalAccount']);
    Route::get('get-coin', [CoinController::class, 'getCoin']);
    Route::get('get-coin/{id}', [CoinController::class, 'getCoin']);
    Route::get('get-payment-method', [AccountController::class, 'getPaymentMethod']);
    Route::prefix('deposit')->group(function () {
        Route::get('/', [AccountController::class, 'deposit']);
        Route::get('/{id}', [AccountController::class, 'deposit']);
        Route::post('/', [AccountController::class, 'deposit']);
    });
    Route::prefix('withdrawal')->group(function () {
        Route::get('/', [AccountController::class, 'withdrawal']);
        Route::get('/{id}', [AccountController::class, 'withdrawal']);
        Route::post('/', [AccountController::class, 'withdrawal']);
    });
});

