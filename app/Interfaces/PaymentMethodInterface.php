<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface PaymentMethodInterface
{
    public function paymentMethodListing(Request $request);
    public function storePaymentMethod(Request $request);
}
