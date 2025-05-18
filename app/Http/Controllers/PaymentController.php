<?php

namespace App\Http\Controllers;

use App\Http\Requests\OnlinePayRequest;
use App\Interfaces\PaymentGatewayInterface;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\PaymentOrder;
use App\Models\ShippingCost;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProfessionalEmail;

class PaymentController extends Controller
{
    protected PaymentGatewayInterface $paymentGateway;

    public function __construct(PaymentGatewayInterface $paymentGateway)
    {
        $this->paymentGateway = $paymentGateway;
    }


    public function paymentProcess(OnlinePayRequest $request)
    {
        try {
            $auth = Auth::id();
            $shippingCost = ShippingCost::first();
            $cart = Cart::where('user_id', $auth)->get();

            if ($cart->isEmpty()) {
                return redirect()->back()->with('error', 'Your cart is empty.');
            }

            $totalPrice = 0;
            foreach ($cart as $item) {
                if ($item->quantity <= 0) {
                    return redirect()->back()->with('error', "Product '{$item->product->name}' is out of stock.");
                }
                $totalPrice += $item->total_price;
            }

            $grandTotal = $totalPrice + $shippingCost->cost;
            $amountCents = (int) ($grandTotal * 100);
            $currency = 'EGP';

            // Extract phone from nested shipping_data array
            $shippingData = $request->input('shipping_data');
            $phone = $shippingData['phone_number'] ?? null;

            // Merge flattened data
            $request->merge([
                'amount_cents' => $amountCents,
                'currency' => $currency,
                'email' => $shippingData['email'] ?? Auth::user()->email,
                'phone' => $phone,
                'first_name' => $shippingData['first_name'] ?? '',
                'last_name' => $shippingData['last_name'] ?? '',
                'address' => $request->input('address'),
            ]);

            return $this->paymentGateway->sendPayment($request);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }




    public function callBack(Request $request)
    {
        $callbackData = $request->all();

        // Optional: Log the callback data to storage for debugging
        Storage::put('paymob_response.json', json_encode($callbackData));

        $orderId = $callbackData['order'] ?? null;
        // Retrieve payment record based on order ID (saved during sendPayment)
        $paymentRecord = PaymentOrder::where('order_id', $orderId)->first();
        // dd($callbackData);die();

        if (!$paymentRecord) {
            return redirect()->route('Home')->with('error', 'Order reference not found.');
        }

        if (isset($callbackData['success']) && $callbackData['success'] === 'true') {
            try {
                DB::beginTransaction();
                $user = Auth::user()->id;
                $shippingCost = ShippingCost::first();
                $cart = Cart::where('user_id', $user)->get();

                if ($cart->isEmpty()) {
                    return redirect()->route('Home')->with('error', 'Your cart is empty.');
                }

                $totalPrice = $cart->sum(fn($item) => $item->total_price) + $shippingCost->cost;

                $order = new Order();
                $order->user_id = $user;
                $order->total_price = $totalPrice;
                $order->phone = $paymentRecord->phone ?? 'not_provided';
                $order->address = $paymentRecord->address ?? 'not_provided';
                $order->transaction_id = $callbackData['id'] ?? null; // Paymob transaction ID
                $order->Payment_type = 'online';
                $order->Payment_status = 'paid';
                $order->status = 'pending';
                $order->save();

                foreach ($cart as $item) {
                    OrderItem::create([
                        'order_id' => $order->id,
                        'product_id' => $item->product_id,
                        'quantity' => $item->quantity,
                        'price' => $item->total_price,
                    ]);
                    $item->delete(); // Clear the cart
                }

                DB::commit();
                $adminEmail = 'rosashop1234@gmail.com'; // Replace this
                $subject = 'New Order Received';
                $message = "A new order (#{$order->id}) has been placed by user ID: {$order->user_id}.\n\nTotal Price: {$totalPrice} EGP";

                Mail::to($adminEmail)->send(
                    new ProfessionalEmail($subject, $message)
                );
                return redirect()->route('Home')->with('success', 'Order created successfully.');
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->route('Home')->with('error', 'Order creation failed: ' . $e->getMessage());
            }
        }

        return redirect()->route('Home')->with('error', 'Payment failed.');
    }
    public function success()
    {

        return view('welcome');
    }
    public function failed()
    {

        return view('welcome');
    }
}
