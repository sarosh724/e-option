<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CoinController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\SettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/*
 *   Authentication Routes
 */

Route::controller(AuthController::class)
    ->group(function () {
        Route::match(['get', 'post'], '/login', 'login')
            ->name('login');
        Route::match(['get', 'post'], '/register/{refcode?}', 'register');
        Route::match(['post', 'get'], '/forgot-password', 'forgotPassword')
            ->name('forgot-password');
        Route::post('/reset-password', 'doResetPassword')
            ->name('do-reset-password');
        Route::get('/reset-password/{token}', 'resetPassword')
            ->name('reset-password');
        Route::get('/logout', 'logout');
        Route::get('authorized/google', 'redirectToGoogle')
            ->name('auth.google');
        Route::get('authorized/google/callback', 'handleGoogleCallback');
    });

/*
 *   Site Routes
 */
Route::get('/', [SiteController::class, 'index']);

Route::group(['middleware' => ['auth']], function () {
    Route::get('/trade', [SiteController::class, 'trade']);
    Route::get('/trade/{tab}', [SiteController::class, 'trade']);
    Route::get('/get-account-balance', [SiteController::class, 'getAccountBalance']);
    Route::post('/change-user-account', [SiteController::class, 'changeUserAccount']);
    Route::post('/change-password', [SiteController::class, 'changePassword']);

    Route::prefix('trading')
        ->group(function () {
            Route::get('/', [SiteController::class, 'trading']);
            Route::get('/coin-rate/{coinId}', [CoinController::class, 'getCoinRateData']);
            Route::get('/get-coin-pump/{coinId}', [CoinController::class, 'getCoinPump']);
            Route::post('/user-trade', [SiteController::class, 'storeUserTrade']);
            Route::get('/history/{id}', [SiteController::class, 'getTradingHistory']);
            Route::get('/history/{id}/{coinId}', [SiteController::class, 'getTradingHistory']);
        });

    Route::get('/settings', [SiteController::class, 'settings']);
    Route::get('/about', [SiteController::class, 'about']);

    Route::get('/withdrawal-accounts', [SiteController::class, 'getWithdrawalAccounts']);
    Route::post('/withdrawal-account', [SiteController::class, 'storeWithdrawalAccount']);

    Route::prefix('deposit')
        ->group(function () {
            Route::get('/', [SiteController::class, 'deposit']);
            Route::post('/', [SiteController::class, 'deposit']);
        });

    Route::prefix('withdrawal')
        ->group(function () {
            Route::get('/', [SiteController::class, 'withdrawal']);
            Route::post('/', [SiteController::class, 'withdrawal']);
        });

    Route::get('/transactions', [SiteController::class, 'transactions']);
    Route::get('/trade-history', [SiteController::class, 'tradeHistory']);
    Route::get('/referral', [SiteController::class, 'referral']);
    Route::get('/account', [SiteController::class, 'account']);
    Route::get('/withdrawal-account', [SiteController::class, 'withdrawalAccount']);
    Route::post('/withdrawal-account', [SiteController::class, 'storeWithdrawalAccount']);
    Route::get('/get-withdrawal-accounts', [SiteController::class, 'getWithdrawalAccount']);
    Route::get('/market', [SiteController::class, 'market']);
    Route::get('/dashboard', [SiteController::class, 'dashboard']);

    Route::get('payment-method/{id}', [SiteController::class, 'getPaymentMethodDetail']);
    Route::post('/profile', [AdminController::class, 'profile']);
});

/*
 *   Admin Panel Routes
 */
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin-dashboard');

    Route::prefix('profile')
        ->group(function () {
            Route::get('/', [AdminController::class, 'profile']);
            Route::post('/', [AdminController::class, 'profile']);
        });

    Route::prefix('users')
        ->group(function () {
            Route::get('/', [AdminController::class, 'getUsers']);
        });

    Route::prefix('deposits')
        ->group(function () {
            Route::get('/', [AdminController::class, 'getDeposits']);
            Route::post('/status', [AdminController::class, 'changeDepositStatus']);
        });

    Route::prefix('withdrawals')
        ->group(function () {
            Route::get('/', [AdminController::class, 'getWithdrawals']);
            Route::post('/status', [AdminController::class, 'changeWithdrawalStatus']);
        });

    Route::prefix('coins')
        ->group(function () {
            Route::get('/', [CoinController::class, 'index']);
            Route::get('/coin-modal', [CoinController::class, 'coinModal']);
            Route::get('/coin-modal/{id}', [CoinController::class, 'coinModal']);
            Route::post('/store', [CoinController::class, 'store']);
            Route::get('/generate-data/{id}/{date}', [CoinController::class, 'generateCoinRateData']);
            Route::get('/pump-modal/{coinId}', [CoinController::class, 'coinPumpModal']);
            Route::get('/view-pump-modal/{coinId}', [CoinController::class, 'viewCoinPumpModal']);
            Route::post('/pump-store', [CoinController::class, 'storeCoinPump']);
        });

    Route::prefix('payment-methods')
        ->group(function () {
            Route::get('/', [PaymentMethodController::class, 'index']);
            Route::get('/modal', [PaymentMethodController::class, 'modal']);
            Route::get('/modal/{id}', [PaymentMethodController::class, 'modal']);
            Route::post('/store', [PaymentMethodController::class, 'store']);
            Route::post('/status', [PaymentMethodController::class, 'changePaymentStatusStatus']);
        });

    Route::prefix('settings')
        ->group(function () {
            Route::get('/', [SettingController::class, 'index']);
            Route::post('/', [SettingController::class, 'store']);
        });
});

# reset
Route::get('reset', function () {
    Artisan::call('route:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
});
