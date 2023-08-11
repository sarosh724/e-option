<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return redirect()->route('admin-dashboard');
    }

    public function dashboard()
    {
        return view('admin.dashboard.dashboard');
    }

    public function getUsers()
    {
        return view('admin.users.listing');
    }

    public function getDeposits()
    {
        return view('admin.deposits.listing');
    }

    public function getWithdrawals()
    {
        return view('admin.withdrawals.listing');
    }

    public function getCoins()
    {
        return view('admin.coins.listing');
    }

    public function getPaymentMethods()
    {
        return view('admin.payment-methods.listing');
    }
}
