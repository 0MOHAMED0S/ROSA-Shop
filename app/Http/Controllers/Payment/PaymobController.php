<?php

namespace App\Http\Controllers\Payment;

use App\Http\Controllers\Controller;
use App\Services\PaymobService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymobController extends Controller
{
    public function pay(PaymobService $paymob)
    {
        $amountCents = 10000; // EGP 100.00

        $authToken = $paymob->authenticate();
        $orderId = $paymob->createOrder($authToken, $amountCents);
        $paymentToken = $paymob->generatePaymentKey($authToken, $orderId, $amountCents);

        $iframeId = 4429694;
        $iframeUrl = "https://accept.paymobsolutions.com/api/acceptance/iframes/{$iframeId}?payment_token={$paymentToken}";

        return redirect($iframeUrl);
    }

    public function callback(Request $request)
    {
        Log::info('Paymob callback:', $request->all());

        // Validate payment result
        if ($request->input('success') == 'true') {
            // Payment successful logic
        } else {
            // Payment failed logic
        }

        return response()->json(['status' => 'received']);
    }

    public function thankYou(Request $request)
    {
        return view($request->input('success') == 'true' ? 'payment.success' : 'payment.failed');
    }


}
