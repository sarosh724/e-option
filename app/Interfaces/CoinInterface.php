<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface CoinInterface
{
    public function coinListing(Request $request);
    public function storeCoin(Request $request);
}
