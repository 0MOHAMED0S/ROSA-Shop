<?php
use App\Http\Controllers\Rosa;
use App\Http\Controllers\AdminRosa;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/Admin/Dashboard', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified','admin'])
    ->name('dashboard');

Route::get('/', [Rosa::class, 'index'])->name('Home');
Route::get('/AboutRosa', [Rosa::class, 'about_rosa'])->name('about_rosa');
Route::get('/ContactUs', [Rosa::class, 'contact_us'])->name('contact_us');
Route::get('/AboutRa3d', [Rosa::class, 'about_ra3d'])->name('about_ra3d');
Route::get('/AllProducts/Details/{id}', [Rosa::class, 'user_details'])->name('user_details');


Route::view('profile', 'profile')
    ->middleware(['auth','verified'])
    ->name('profile');

    Route::middleware(['auth','verified','admin'])->group(function () {
        Route::get('/Admin/Dashboard/AllProducts', [AdminRosa::class, 'all_products'])->name('all_products');
        Route::get('/Admin/Dashboard/AllProducts/Create', [AdminRosa::class, 'Create'])->name('Create');
        Route::post('/Admin/Dashboard/AllProducts/store', [AdminRosa::class, 'store'])->name('store');
        Route::get('/Admin/Dashboard/AllProducts/edit/{id}', [AdminRosa::class, 'edit'])->name('edit');
        Route::put('/Admin/Dashboard/AllProducts/update/{id}', [AdminRosa::class, 'update'])->name('update');
        Route::get('/Admin/Dashboard/AllProducts/delete/{id}', [AdminRosa::class, 'delete'])->name('delete');
        Route::delete('/Admin/Dashboard/AllProducts/destroy/{id}', [AdminRosa::class, 'destroy'])->name('destroy');
        Route::get('/Admin/Dashboard/AllProducts/Details/{id}', [AdminRosa::class, 'admin_details'])->name('admin_details');
        Route::get('/Admin/Dashboard/AllOrders', [AdminRosa::class, 'AllOrders'])->name('AllOrders');
        Route::post('/Admin/Dashboard/AllOrders/Done', [AdminRosa::class, 'AllOrdersDone'])->name('AllOrdersDone');
        Route::get('/Admin/Dashboard/DoneOrders', [AdminRosa::class, 'DoneOrders'])->name('DoneOrders');
    });

    Route::middleware(['auth','verified'])->group(function () {
        Route::get('/cart/check_out', [Rosa::class, 'check_out'])->name('check_out');
        Route::get('/cart/UserOrders', [Rosa::class, 'UserOrders'])->name('UserOrders');
        Route::get('/cart/UserOrdersDone', [Rosa::class, 'UserOrdersDone'])->name('UserOrdersDone');
        Route::post('/stripe', [Rosa::class, 'stripe'])->name('stripe.post');
        Route::get('/Cart', [Rosa::class, 'cart'])->name('cart');
        Route::get('/cart/delete/{id}', [Rosa::class, 'del_cart'])->name('del_cart');
        Route::get('/Favorites', [Rosa::class, 'favorites'])->name('favorites');
    });

require __DIR__.'/auth.php';
