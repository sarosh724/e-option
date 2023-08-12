<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\AuthController;
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

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'register']);
Route::get('/forgot', [AuthController::class, 'forgot']);
Route::get('/reset', [AuthController::class, 'reset']);

// Site Routes
Route::get('/', [SiteController::class, 'index']);
Route::get('/trading', [SiteController::class, 'trading']);
Route::get('/settings', [SiteController::class, 'settings']);
Route::get('/about', [SiteController::class, 'about']);

Route::get('/withdrawal-accounts', [SiteController::class, 'getWithdrawalAccounts']);
Route::post('/withdrawal-account', [SiteController::class, 'storeWithdrawalAccount']);

Route::prefix('deposit')->group(function () {
    Route::get('/', [SiteController::class, 'deposit']);
    Route::post('/', [SiteController::class, 'deposit']);
});

Route::prefix('withdrawal')->group(function () {
    Route::get('/', [SiteController::class, 'withdrawal']);
    Route::post('/', [SiteController::class, 'withdrawal']);
});

// Admin Panel Routes
Route::prefix('admin')->group(function () {
   Route::get('/', [AdminController::class, 'index']);
   Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin-dashboard');

   Route::prefix('users')->group(function () {
       Route::get('/', [AdminController::class, 'getUsers']);
   });

    Route::prefix('deposits')->group(function () {
        Route::get('/', [AdminController::class, 'getDeposits']);
    });

    Route::prefix('withdrawals')->group(function () {
        Route::get('/', [AdminController::class, 'getWithdrawals']);
    });

    Route::prefix('coins')->group(function () {
        Route::get('/', [AdminController::class, 'getCoins']);
    });

    Route::prefix('payment-methods')->group(function () {
        Route::get('/', [AdminController::class, 'getPaymentMethods']);
    });
});
