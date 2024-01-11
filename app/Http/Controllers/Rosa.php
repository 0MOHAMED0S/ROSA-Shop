<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\favorites;
use App\Models\Order;
use App\Models\OrdersDone;
use App\Models\rosa as ModelsRosa;
use App\Models\UserDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Stripe;

class Rosa extends Controller
{
    public function index(){
        $roses = ModelsRosa::get();
        return view('MainPages.index',compact('roses'));
    }

    public function user_details($id){
        $rose = ModelsRosa::find($id);
        return view('MainPages.UserDetails',compact('rose'));
    }

    public function about_rosa(){
        return view('MainPages.AboutRosa');
    }

    public function contact_us(){
        return view('MainPages.ContactUs');
    }
    public function about_ra3d(){
        return view('MainPages.AboutRa3d');
    }


    public function UserOrders(){
        $auth=Auth::id();
        $orders =  Order::where('user_id' ,$auth)->get();
        return view('MainPages.UserOrders',compact('orders'));
    }

    public function UserOrdersDone(){
        $auth=Auth::id();
        $orders =OrdersDone::where('user_id' ,$auth)->get();
        return view('MainPages.UserOrdersDone',compact('orders'));
    }

    public function cart()
    {
        $auth = Auth::id();
        $carts = cart::where('user_id', $auth)->get();
        return view('MainPages.cart', compact('carts'));
    }

    public function favorites()
    {
        $auth = Auth::id();
        $favorites = favorites::where('user_id', $auth)->get();
        return view('MainPages.favorites', compact('favorites'));
    }
    public function del_cart($id)
    {
        $auth = Auth::id();
        $carts = cart::where('user_id', $auth)->find($id);
        // Check if the product exists
        if (!$carts) {
            return redirect()->route('cart')->with('error', 'Product not found');
        }

        // Proceed with the deletion
        $carts->delete();

        return redirect()->route('cart')->with('success', 'Data deleted successfully');
    }


    public function stripe(Request $request)
    {
        $validatedData = $request->validate([
            'address' => 'required|string',
            'number' => 'required|string',
        ]);
        try {
            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));

            // Create Stripe charge
            $stripeCharge = Stripe\Charge::create([
                "amount" => $request->totalprice * 100,
                "currency" => "EGP",
                "source" => $request->stripeToken,
                "description" => "Test payment from itsolutionstuff.com."
            ]);

            // Start a database transaction
            DB::beginTransaction();

            try {
                $auth = Auth::id();
                $cart = Cart::where('user_id', $auth)->get();

                foreach ($cart as $item) {
                    // Create Order
                    $order = new Order;
                    $order->quantity = $item->quantity;
                    $order->total_price = $item->total_price;
                    $order->user_id = $item->user_id;
                    $order->rosa_id = $item->rosa_id;
                    $order->address =  $validatedData['address'];
                    $order->number = $validatedData['number'];
                    $order->save();
                    // Delete the item from the cart
                    $item->delete();
                }
                DB::commit();
            } catch (\Exception $e) {
                // Rollback the transaction on exception
                DB::rollback();

                // return response()->json(['error' => 'Failed to create order.'], 500);
                return redirect()->back()->with('error', 'Failed to create order.');
            }

            // Continue with any other post-purchase logic
            // return response()->json(['message' => 'Payment and order creation successful.']);

            return redirect()->route('Home')->with('success','Payment and order creation successful.');
        } catch (\Exception $e) {
            // Handle Stripe exceptions
            // return response()->json(['error' => $e->getMessage()], 500);
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function check_out()
    {
        $auth = Auth::id();
        $cart = Cart::where('user_id', $auth)->get(); // Assuming you have a Cart model or class to retrieve the cart
        $totalPrice = 0;

        foreach ($cart as $item) {
            // Assuming there is a 'total_price' property in each item
            $totalPrice += $item->total_price;
        }
        // dd($totalPrice);


        return view('MainPages.visa', compact('totalPrice', 'cart'));
    }

}
