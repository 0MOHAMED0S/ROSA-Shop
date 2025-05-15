<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class PaymobService
{
    protected $apiKey;
    protected $baseUrl;

    public function __construct()
    {
        $this->apiKey = config('services.paymob.api_key');
        $this->baseUrl = 'https://accept.paymobsolutions.com/api';
    }

    public function authenticate()
    {
        $response = Http::post("{$this->baseUrl}/auth/tokens", [
            'api_key' => $this->apiKey,
        ]);

        return $response['token'];
    }

    public function createOrder($token, $amountCents)
    {
        $response = Http::post("{$this->baseUrl}/ecommerce/orders", [
            'auth_token' => $token,
            'delivery_needed' => false,
            'amount_cents' => $amountCents,
            'items' => [],
        ]);

        return $response['id'];
    }

    public function generatePaymentKey($token, $orderId, $amountCents)
    {
        $billingData = [
            "apartment" => "NA",
            "email" => "test@example.com",
            "floor" => "NA",
            "first_name" => "Test",
            "street" => "NA",
            "building" => "NA",
            "phone_number" => "0123456789",
            "shipping_method" => "NA",
            "postal_code" => "NA",
            "city" => "Cairo",
            "country" => "EG",
            "last_name" => "User",
            "state" => "Cairo",
        ];

        $response = Http::post("{$this->baseUrl}/acceptance/payment_keys", [
            'auth_token' => $token,
            'amount_cents' => $amountCents,
            'expiration' => 3600,
            'order_id' => $orderId,
            'billing_data' => $billingData,
            'currency' => 'EGP',
            'integration_id' => config('services.paymob.integration_id'),
        ]);

        return $response['token'];
    }
}
