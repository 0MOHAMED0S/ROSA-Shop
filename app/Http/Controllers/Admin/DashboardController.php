<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        $orderCount = Order::count();
        $sectionCount = Section::count();
        $productCount = Product::count();
        $userCount = User::count();
        return view('Admin.dashboard',compact('orderCount','productCount','sectionCount','userCount'));
    }
    public function users()
{
    $users = User::withCount('orders')->get();
    return view('Admin.Users.AllUsers', compact('users'));
}

}
