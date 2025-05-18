<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ProfessionalEmail;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::get();
        return view('Admin.Orders.AllOrders', compact('orders'));
    }
    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('Admin.Orders.OrderDetails', compact('order'));
    }

public function StatusUpdate(Request $request, $id)
{
    try {
        $request->validate([
            'status' => 'required|in:pending,in progress,completed,canceled',
        ]);

        // Find the order
        $order = Order::findOrFail($id);
        $user = $order->user; // Make sure Order model has a 'user' relationship
        // Update the order status
        $order->status = $request->status;

        // Update payment status based on order status
        if ($request->status === 'completed') {
            $order->payment_status = 'paid';
        } else {
            $order->payment_status = 'unpaid';
        }

        $order->save();

        // Prepare email data
        $data = [
            'subject' => 'Your Order Status Has Been Updated',
            'message' => "Dear {$user->name},\n\nYour order status has been updated to '{$order->status}'.\nPayment status: {$order->payment_status}.\n\nThank you for shopping with us."
        ];

        // Send the email
        Mail::to($user->email)->send(new ProfessionalEmail($data['subject'], $data['message']));

        return redirect()->back()->with('success', 'Order status, payment updated, and email sent successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }
}

}
