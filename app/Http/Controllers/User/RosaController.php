<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventCodeRequest;
use App\Http\Requests\OrderRequest;
use App\Models\Cart;
use App\Models\EventCode;
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
    public function Paymethod()
    {
        return view('User.paymentWay');
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
    
    // public function event()
    // {
    //     $user = Auth::user();

    //     // Fetch specific products by ID
    //     $products = Product::whereIn('id', [2, 1])->get();

    //     return view('User.event', [
    //         'history' => $this->getHistory($user->id),
    //         'products' => $products,
    //     ]);
    // }
    // public function tryCode(EventCodeRequest $request)
    // {
    //     $user = Auth::user();

    //     // Count how many tries the user already has
    //     $attempts = EventCode::where('user_id', $user->id)->count();

    //     if ($attempts >= 5) {
    //         return redirect()->back()->with([
    //             'message' => '🚫 You have reached your 5 tries limit.',
    //             'success' => false,
    //             'history' => $this->getHistory($user->id),
    //         ]);
    //     }

    //     // Combine digits into full code
    //     $inputCode = implode('', $request->code);
    //     $correctCode = '505';
    //     $isCorrect = $inputCode === $correctCode;

    //     // Store attempt in DB
    //     EventCode::create([
    //         'user_id' => $user->id,
    //         'code' => $inputCode,
    //     ]);

    //     // Set response message
    //     $message = $isCorrect
    //         ? '🎉 Correct! You unlocked the safe.'
    //         : '❌ Wrong code. Try again.';

    //     // Send back to view with session data
    //     return redirect()->back()->with([
    //         'message' => $message,
    //         'success' => $isCorrect,
    //         'history' => $this->getHistory($user->id),
    //     ]);
    // }
    // protected function getHistory($userId)
    // {
    //     return EventCode::where('user_id', $userId)
    //         ->latest()
    //         ->take(10)
    //         ->get()
    //         ->map(function ($attempt) {
    //             return [
    //                 'code' => str_split($attempt->code),
    //                 'success' => $attempt->code === '5055',
    //             ];
    //         })
    //         ->toArray();
    // }


    public function about_rosa()
    {
        return view('User.AboutRosa');
    }
}
