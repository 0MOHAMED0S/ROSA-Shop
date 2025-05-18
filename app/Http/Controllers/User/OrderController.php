<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Mail\ProfessionalEmail;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShippingCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{
    public function check_out()
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
            return view('User.CheckOut', compact('totalPrice', 'cart', 'shippingCost'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function order(OrderRequest $request)
    {
        try {
            DB::beginTransaction();
            $validatedData = $request->validated();
            $auth = Auth::id();
            $shippingCost = ShippingCost::first();
            $cart = Cart::where('user_id', $auth)->get();

            if ($cart->isEmpty()) {
                return redirect()->back()->with('error', 'Your cart is empty. Please add items before placing an order.');
            }

            $totalPrice = $cart->sum(function ($item) {
                return $item->total_price;
            }) + $shippingCost->cost;
            $order = new Order();
            $order->user_id = $auth;
            $order->total_price = $totalPrice;
            $order->phone = $validatedData['phone'];
            $order->address = $validatedData['address'];
            $order->status = 'pending';
            $order->save();
            foreach ($cart as $item) {
                if ($item->quantity <= 0) {
                    DB::rollBack();
                    return redirect()->back()->with('error', 'Some items in your cart are out of stock.');
                }
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->total_price
                ]);
                $item->delete();
            }
            DB::commit();
            $adminEmail = 'rosashop1234@gmail.com'; // Replace this
            $subject = 'New Order Received';
            $message = "A new order (#{$order->id}) has been placed by user ID: {$auth}.\n\nTotal Price: {$totalPrice} EGP";

            Mail::to($adminEmail)->send(
                new ProfessionalEmail($subject, $message)
            );
            return redirect()->route('Home')->with('success', 'Order Created successfuly.');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Failed to create order: ' . $e->getMessage());
        }
    }
    public function UserOrders()
    {
        $auth = Auth::id();
        $orders = Order::where('user_id', $auth)->get();
        return view('User.orders.UserOrders', compact('orders'));
    }

    public function online_check_out()
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
            return view('User.pay.online', compact('totalPrice', 'cart', 'shippingCost'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('User.orders.OrderDetails', compact('order'));
    }
}
