<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface CoinInterface
{
    public function coinListing(Request $request, $id);
    public function storeCoin(Request $request);
}
