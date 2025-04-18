<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Models\Section;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $sections = Section::get();
        $products = Product::get();
        return view('Admin.Products.AllProducts', compact('products', 'sections'));
    }
    public function create()
    {
        $sections = Section::get();
        return view('Admin.Products.AddProduct', compact('sections'));
    }
    public function store(ProductRequest $request)
    {
        try {
            $data = $request->validated();
            $path = $request->file('path')->store('ProductImages', 'public');
            $data['path'] = $path;
            Product::create($data);
            return redirect()->back()->with('success', 'The Product Added Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function update(ProductRequest $request, $id)
    {
        try {
            $product = Product::findOrFail($id);
            $data = $request->validated();
    
            // Handle Image Upload
            if ($request->hasFile('path')) {
                if ($product->path && Storage::disk('public')->exists($product->path)) {
                    Storage::disk('public')->delete($product->path);
                }
                $path = $request->file('path')->store('ProductImages', 'public');
                $data['path'] = $path;
            } else {
                $data['path'] = $product->path;
            }
    
            // Handle Discount as a Normal Number (only apply if changed)
            $price = $data['price'];
            $discount = $data['discount'] ?? 0; // Default to 0 if not provided
    
            // Check if the discount has changed
            if (isset($data['discount']) && $data['discount'] !== $product->discount) {
                // Ensure that discount is not greater than or equal to the product price
                if ($discount >= $price) {
                    return redirect()->back()->with('error', 'Discount cannot be greater than or equal to the product price.');
                }
    
                $finalPrice = $price;
    
                // Ensure final price is not less than 1
                if ($finalPrice < 1) {
                    return redirect()->back()->with('error', 'Final price after discount cannot be less than 1.');
                }
    
                $data['price'] = $finalPrice; // Save the updated price
            } else {
                // If discount was not changed, keep the original price
                $data['price'] = $product->price; // Retain the original price if discount is not changed
            }
    
            // Update the product
            $product->update($data);
    
            return redirect()->back()->with('success', 'The Product Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    


    public function destroy($id)
    {
        try {
            $product = Product::findOrFail($id);
            if ($product->path && Storage::disk('public')->exists($product->path)) {
                Storage::disk('public')->delete($product->path);
            }
            $product->delete();
            return redirect()->back()->with('success', 'The Product Deleted Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
