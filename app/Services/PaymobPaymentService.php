<?php

namespace App\Services;

use App\Interfaces\PaymentGatewayInterface;
use App\Models\PaymentOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymobPaymentService extends BasePaymentService implements PaymentGatewayInterface
{
    /**
     * Create a new class instance.
     */
    protected $api_key;
    protected $integrations_id;

    public function __construct()
    {
        $this->base_url = env("BAYMOB_BASE_URL");
        $this->api_key = env("BAYMOB_API_KEY");
        $this->header = [
            'Accept' => 'application/json',
            'Content-Type' => 'application/json',
        ];

        $this->integrations_id = [5091607,5091590];
    }

//first generate token to access api
    protected function generateToken()
    {
        $response = $this->buildRequest('POST', '/api/auth/tokens', ['api_key' => $this->api_key]);
        return $response->getData(true)['data']['token'];
    }

public function sendPayment(Request $request)
{
    $this->header['Authorization'] = 'Bearer ' . $this->generateToken();

    // Validate or process the data before sending it
    $data = $request->all();
    $data['api_source'] = "INVOICE";
    $data['integrations'] = $this->integrations_id;

    $response = $this->buildRequest('POST', '/api/ecommerce/orders', $data);
    $responseData = $response->getData(true);

    if ($responseData['success']) {
        $orderId = $responseData['data']['id']; // Paymob order ID

        $url = $responseData['data']['url'];    // payment URL

        PaymentOrder::create([
            'order_id' => $orderId,                         // Save Paymob order ID
            'phone'    => $data['phone'] ?? null,
            'address'  => $data['address'] ?? null,
        ]);

        return redirect()->to($url);
    }

    return redirect()->back()->with('error', 'Payment process failed. Please try again.');
}



    public function callBack(Request $request): bool
    {
        $response = $request->all();
        Storage::put('paymob_response.json', json_encode($request->all()));

        if (isset($response['success']) && $response['success'] === 'true') {

            return true;
        }
        return false;
    }


}
