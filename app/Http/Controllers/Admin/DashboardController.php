<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $orderCount = Order::count();
        $sectionCount = Section::count();
        $productCount = Product::count();
        $userCount = User::count();
        return view('Admin.dashboard', compact('orderCount', 'productCount', 'sectionCount', 'userCount'));
    }
    public function users()
    {
        $users = User::withCount('orders')->get();
        return view('Admin.Users.AllUsers', compact('users'));
    }
    public function updateRole($id)
    {
        try {
            // Check if the logged-in user is an admin
            if (Auth::user()->status != 1) {
                return redirect()->back()->with('error', 'Unauthorized action.');
            }

            $user = User::findOrFail($id);

            // Prevent changing your own role
            if ($user->id == Auth::id()) {
                return redirect()->back()->with('error', 'You cannot change your own role.');
            }

            // Toggle the user role
            $user->status = $user->status == 1 ? 0 : 1;
            $user->save();

            return redirect()->back()->with('success', 'User role updated successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'An error occurred: ' . $e->getMessage());
        }
    }
}
