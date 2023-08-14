<?php

namespace App\Repositories;

use App\Interfaces\DashboardInterface;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Withdraw;

class DashboardRepository implements DashboardInterface
{
    public function totalUsers()
    {
        return User::where("is_admin", 0)->get()->count();
    }

    public function pendingDeposits()
    {
        return Deposit::where("status", "pending")->get()->count();
    }

    public function completedDeposits()
    {
        return Deposit::where("status", "approved")->get()->count();
    }

    public function completedWithdrawals()
    {
        return Withdraw::where("status", "approved")->get()->count();
    }
}
