<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RosaController extends Controller
{
    public function index(Request $request)
    {
        $sections = Section::all();
        $query = Product::query();
        if ($request->has('section_id') && $request->section_id != '') {
            $query->where('section_id', $request->section_id);
        }
        if ($request->has('search') && $request->search != '') {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $products = $query->paginate(12);
        return view('User.index', compact('sections', 'products'));
    }

    public function favorites()
    {
        $auth = Auth::id();

        // Retrieve user's favorite products with product details
        $products = Favorite::where('user_id', $auth)
            ->with('product') // Eager loading the related product
            ->get();

        return view('User.favorites', compact('products'));
    }
    public function cart()
    {
        $auth = Auth::id();
        $carts = Cart::where('user_id', $auth)->get();
        return view('User.cart', compact('carts'));
    }

    public function del_cart($id)
    {
        try {
            $auth = Auth::id();
            $cartItem = Cart::where('user_id', $auth)->where('id', $id)->first();
            if (!$cartItem) {
                return redirect()->route('cart')->with('error', 'Product not found in your cart.');
            }
            $cartItem->delete();
            return redirect()->route('cart')->with('success', 'Item removed from cart successfully.');
        } catch (\Exception $e) {
            return redirect()->route('cart')->with('error', 'Something went wrong! ' . $e->getMessage());
        }
    }
    public function product_details($id){
        $product=Product::findOrFail($id);
        return view('User.ProductDetails',compact('product'));
    }
    public function check_out()
{
    try {
        $auth = Auth::id();
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
        return view('User.CheckOut', compact('totalPrice', 'cart'));
    } catch (\Exception $e) {
        return redirect()->back()->with('error', 'Something went wrong. Please try again.');
    }
}

public function order(OrderRequest $request)
{
    $validatedData = $request->validated(); // Validate input from OrderRequest
    $auth = Auth::id();
    $cart = Cart::where('user_id', $auth)->get();

    // Check if the cart is empty
    if ($cart->isEmpty()) {
        return redirect()->back()->with('error', 'Your cart is empty. Please add items before placing an order.');
    }

    try {
        DB::beginTransaction();

        // Calculate total price
        $totalPrice = $cart->sum(function ($item) {
            return $item->total_price;
        }) + 50; // Adding fixed shipping cost

        // Create order
        $order = new Order();
        $order->user_id = $auth;
        $order->total_price = $totalPrice;
        $order->phone = $validatedData['phone'];
        $order->address = $validatedData['address'];

        $order->status = 'pending'; // Default status
        $order->save();

        // Insert items into order_items table
        foreach ($cart as $item) {
            // Check if product quantity is 0
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

            // Remove item from cart
            $item->delete();
        }

        DB::commit();
        return redirect()->route('Home')->with('success', 'Order Created successfuly.');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'Failed to create order: ' . $e->getMessage());
    }
}

public function UserOrders(){
    $auth=Auth::id();
    $orders = Order::where('user_id' ,$auth)->get();
    return view('User.orders.UserOrders',compact('orders'));
}
public function show($id)
{
    $order = Order::with('items')->findOrFail($id);
    return view('User.orders.OrderDetails', compact('order'));
}

public function about_rosa(){
    return view('User.AboutRosa');
}
}
