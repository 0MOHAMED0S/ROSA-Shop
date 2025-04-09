<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NumberRequest;
use App\Models\Number;
use Illuminate\Http\Request;
use Exception;

class NumberController extends Controller
{
    public function index()
    {
        $number=Number::first();
        return view('Admin.Numbers.numbers',compact('number'));
    }
    public function update(NumberRequest $request, $id)
    {
        try {
            $data = $request->validated();
            $number = Number::findOrFail($id);
            $number->update($data);
            return redirect()->back()->with('success', 'The Numbers Updated Successfully');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
