<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\Favorite;
use App\Models\Number;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Section;
use App\Models\ShippingCost;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RosaController extends Controller
{
    public function index(Request $request)
    {
        $sections = Section::all();
        $number = Number::first();
        // Get top-selling products based on order count
        $products = Product::leftJoin('order_items', 'order_items.product_id', '=', 'products.id')
            ->selectRaw('products.id, products.name, products.description, products.price, products.discount, products.path, products.section_id, COUNT(order_items.id) as order_count')
            ->groupBy('products.id', 'products.name', 'products.description', 'products.price', 'products.discount', 'products.path', 'products.section_id') // Explicitly group by all selected columns
            ->orderByDesc('order_count')
            ->limit(5)
            ->get();

        // If no best-sellers found, fallback to latest products
        if ($products->isEmpty()) {
            $products = Product::latest()->limit(5)->get();
        }

        return view('User.index', compact('sections', 'products', 'number'));
    }


    public function AllProducts(Request $request)
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
        return view('User.AllProducts', compact('sections', 'products'));
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
    public function product_details($id)
    {
        $product = Product::findOrFail($id);
        return view('User.ProductDetails', compact('product'));
    }
    public function check_out()
    {
        try {
            $auth = Auth::id();
            $shippingCost=ShippingCost::first();
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
            return view('User.CheckOut', compact('totalPrice', 'cart','shippingCost'));
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
            $shippingCost=ShippingCost::first();
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
    public function show($id)
    {
        $order = Order::with('items')->findOrFail($id);
        return view('User.orders.OrderDetails', compact('order'));
    }

    public function about_rosa()
    {
        return view('User.AboutRosa');
    }
}
