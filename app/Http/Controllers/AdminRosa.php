<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrdersDone;
use App\Models\rosa;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\QueryException;

class AdminRosa extends Controller
{
    public function all_products()
    {
        $roses = rosa::get();
        return view('MainPages.AdminPages.AllProducts', compact('roses'));
    }

    public function AllOrders()
    {
        // Controller or wherever you retrieve users
        $users = User::with('orders')->get();
        return view('MainPages.AdminPages.AllOrders', compact('users'));
    }
    public function DoneOrders()
    {
        // Controller or wherever you retrieve users
        $users = User::with('OrdersDone')->get();
        return view('MainPages.AdminPages.DoneOrders', compact('users'));
    }
    public function admin_details($id)
    {
        $rose = rosa::find($id);
        return view('MainPages.AdminPages.AdminProductDetails', compact('rose'));
    }


    public function Create()
    {
        return view('MainPages.AdminPages.create');
    }

    public function AllOrdersDone(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'address' => 'required|string',
                'date' => 'required|date|date_format:Y-m-d', // Adjust the format if needed
                'number' => 'required|integer',
                'user_id'=>'required|integer',
            ]);

            // Use the Carbon instance to format the date for comparison
            $formattedDate = \Carbon\Carbon::parse($validatedData['date'])->format('Y-m-d');

            // Get orders based on the validated data
            $ordersToMove = Order::where('address', $validatedData['address'])
                ->where('number', $validatedData['number'])
                ->where('user_id', $validatedData['user_id'])
                ->whereDate('created_at', $formattedDate)
                ->get();

            // Store the orders in the 'ordersdone' table
            foreach ($ordersToMove as $order) {
                OrdersDone::create([
                    'address' => $order->address,
                    'number' => $order->number,
                    'MoveDate' =>  $formattedDate,
                    'user_id'=>$order->user_id,
                    'rosa_id'=>$order->rosa_id,
                    'total_price'=>$order->total_price,
                    'quantity'=>$order->quantity,
                    'payments'=>$order->payments,
                ]);
            }

            // Delete the orders from the original table
            $ordersToDelete = Order::where('address', $validatedData['address'])
                ->where('number', $validatedData['number'])
                ->where('user_id', $validatedData['user_id'])
                ->whereDate('created_at', $formattedDate)
                ->delete();

            // You can return a response or perform additional actions if needed
            return redirect()->route('AllOrders')->with('success', 'Orders moved to ordersdone table and deleted from the original table.');
        } catch (ValidationException $e) {
            // Handle validation errors
            return redirect()->route('AllOrders')->with('error',  $e->validator->errors());
        } catch (QueryException $e) {
            // Handle database query errors
            return redirect()->route('AllOrders')->with('error',  'Database error.');
        } catch (\Exception $e) {
            // Handle other unexpected errors
            return redirect()->route('AllOrders')->with('error',  'An unexpected error occurred.');
        }
    }


    public function  store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'discount' => 'integer',
            'path' => 'required|image',
        ]);

        $image = $request->file('path'); // Assuming 'path' is the file input
        $imageName = $image->getClientOriginalName(); // You can customize this as needed

        $path = $image->storeAs('product_images', $imageName, 'public');
        $roses = new rosa;
        $roses->title = $validatedData['title'];
        $roses->description = $validatedData['description'];
        $roses->price = $validatedData['price'];
        $roses->path = $path;
        $roses->save();
        return redirect()->route('all_products')->with('success', 'Data stored successfully');
    }
    public function  edit($id)
    {
        $rose = rosa::find($id);
        return view('MainPages.AdminPages.edit', compact('rose'));
    }

    public function  update(Request $request, $id)
    {
        $roses =  rosa::find($id);
        $validatedData = $request->validate([
            'title' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|numeric|regex:/^\d+(\.\d{1,2})?$/',
            'discount' => 'numeric|regex:/^\d+(\.\d{1,2})?$/',
            'path' => 'image',
        ]);
        if ($request->file('path')) {
            $image = $request->file('path');
            $imageName = $image->getClientOriginalName();
            $path = $image->storeAs('product_images', $imageName, 'public');
        } else {
            $path = $roses->path;
        }
        $roses->title = $validatedData['title'];
        $roses->description = $validatedData['description'];
        $roses->price = $validatedData['price']-$validatedData['discount'];;
        $roses->discount = $validatedData['discount'];
        $roses->path = $path;
        $roses->save();

        return redirect()->route('all_products')->with('success', 'Data updated successfully');
    }

    public function  delete($id)
    {
        $rose = rosa::find($id);
        return view('MainPages.AdminPages.delete', compact('rose'));
    }

    public function  destroy($id)
    {
        $product = rosa::find($id);
        // Check if the product exists
        if (!$product) {
            return redirect()->route('all_products')->with('error', 'Product not found');
        }

        // Proceed with the deletion
        $product->delete();

        return redirect()->route('all_products')->with('success', 'Data deleted successfully');
    }
}
