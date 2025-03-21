<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

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

        // Update the order status
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }
}



}
