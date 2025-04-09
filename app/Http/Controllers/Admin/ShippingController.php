<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ShippingRequest;
use App\Models\ShippingCost;
use Illuminate\Http\Request;
use Exception;
class ShippingController extends Controller
{
    public function index()
    {
        $shipping=ShippingCost::first();
        return view('Admin.Shipping.shipping',compact('shipping'));
    }
    public function update(ShippingRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $shipping = ShippingCost::findOrFail($id);
            $shipping->update($data);
            return redirect()->back()->with('success', 'The Shipping Cost Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
