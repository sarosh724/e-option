<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteController;
use Illuminate\Support\Facades\Route;

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

Route::controller(AuthController::class)->group(function () {
        Route::match(['get', 'post'], '/login', 'login')
            ->name('login');
        Route::match(['get', 'post'], '/register', 'register');
        Route::get('/forgot', 'forgot');
        Route::get('/reset', 'reset');
        Route::get('/logout', 'logout');
        Route::get('authorized/google', 'redirectToGoogle')
            ->name('auth.google');
        Route::get('authorized/google/callback', 'handleGoogleCallback');
    });

/*
 *   Site Routes
 */

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [SiteController::class, 'index']);
    Route::get('/trading', [SiteController::class, 'trading']);
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
});

/*
 *   Admin Panel Routes
 */
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'isAdmin']], function () {
    Route::get('/', [AdminController::class, 'index']);
    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin-dashboard');

    Route::prefix('users')
        ->group(function () {
            Route::get('/', [AdminController::class, 'getUsers']);
        });

    Route::prefix('deposits')
        ->group(function () {
            Route::get('/', [AdminController::class, 'getDeposits']);
        });

    Route::prefix('withdrawals')
        ->group(function () {
            Route::get('/', [AdminController::class, 'getWithdrawals']);
        });

    Route::prefix('coins')
        ->group(function () {
            Route::get('/', [\App\Http\Controllers\CoinController::class, 'index']);
            Route::get('/coin-modal', [\App\Http\Controllers\CoinController::class, 'coinModal']);
            Route::get('/coin-modal/{id}', [\App\Http\Controllers\CoinController::class, 'coinModal']);
            Route::post('/store', [\App\Http\Controllers\CoinController::class, 'store']);
        });

    Route::prefix('payment-methods')
        ->group(function () {
            Route::get('/', [\App\Http\Controllers\PaymentMethodController::class, 'index']);
            Route::get('/modal', [\App\Http\Controllers\PaymentMethodController::class, 'modal']);
            Route::get('/modal/{id}', [\App\Http\Controllers\PaymentMethodController::class, 'modal']);
            Route::post('/store', [\App\Http\Controllers\PaymentMethodController::class, 'store']);
        });
});
