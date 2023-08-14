<?php

namespace App\Interfaces;

interface DashboardInterface
{
    public function totalUsers();
    public function pendingDeposits();
    public function completedWithdrawals();
    public function completedDeposits();
}
