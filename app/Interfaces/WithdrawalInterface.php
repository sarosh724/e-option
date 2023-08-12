<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface WithdrawalInterface
{
    public function listing(Request $request);
    public function updateStatus(Request $request);
}
