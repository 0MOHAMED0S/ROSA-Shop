<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\NumberController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Rosa;
use App\Http\Controllers\AdminRosa;
use App\Http\Controllers\Auth\googleAuthController;
use App\Http\Controllers\Payment\PaymentController;
use App\Http\Controllers\Payment\PaymobController;
use App\Http\Controllers\PaymentController as ControllersPaymentController;
use App\Http\Controllers\User\ContactController;
use App\Http\Controllers\User\MessageController;
use App\Http\Controllers\User\RosaController;
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


// ========================== Public Routes ==========================
Route::get('/', [RosaController::class, 'index'])->name('Home');
Route::get('/products', [RosaController::class, 'AllProducts'])->name('AllProducts');
Route::get('/about-rosa', [RosaController::class, 'about_rosa'])->name('about.rosa');
Route::get('/products/{id}', [RosaController::class, 'product_details'])->name('product.details');

Route::get('/contact-us', [ContactController::class, 'index'])->middleware('auth')->name('contact.rosa');
Route::post('/contact-us', [ContactController::class, 'send'])->middleware('auth')->name('contact.send.rosa');

// users Management
Route::prefix('blogs')->name('blogs.')->group(function () {
    Route::get('/', [RosaController::class, 'blogs'])->name('index');
    Route::get('/1', [RosaController::class, 'blogs_flowers'])->name('flowers');
    Route::get('/2', [RosaController::class, 'blogs_makeup'])->name('makeup');
    Route::get('/3', [RosaController::class, 'blogs_bags'])->name('bags');
    Route::get('/4', [RosaController::class, 'blogs_gifts'])->name('gifts');
    Route::get('/5', [RosaController::class, 'blogs_care'])->name('care');
});
// ========================== Authentication Routes ==========================
Route::middleware(['guest'])->group(function () {
    Route::get('/login/google', [GoogleAuthController::class, 'redirectToGoogle'])->name('auth.google');
    Route::get('/login/google/callback', [GoogleAuthController::class, 'handleGoogleCallback']);
});

// ========================== User Profile Routes ==========================
Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/profile', 'profile')->name('profile');
    Route::post('/logout', [GoogleAuthController::class, 'logout'])->name('logout');

    // Cart & Order Management
    Route::get('/cart', [RosaController::class, 'cart'])->name('cart');
    Route::get('/cart/check-out', [RosaController::class, 'check_out'])->name('cart.checkout');
    Route::post('/cart/check-out', [RosaController::class, 'order'])->name('cart.order');
    Route::get('/cart/delete/{id}', [RosaController::class, 'del_cart'])->name('cart.delete');

    // Orders
    Route::get('/user/orders', [RosaController::class, 'UserOrders'])->name('user.orders');
    Route::get('/order/{id}', [RosaController::class, 'show'])->name('order.details');

    // Favorites
    Route::get('/favorites', [RosaController::class, 'favorites'])->name('favorites');

    //events
    Route::get('/events', [RosaController::class, 'event'])->name('events.index');
    Route::post('/events', [RosaController::class, 'tryCode'])->name('events.try');

    Route::get('/pay', [PaymobController::class, 'pay']);
    Route::post('/paymob/callback', [PaymobController::class, 'handleCallback']);

});
Route::post('/payment/process', [ControllersPaymentController::class, 'paymentProcess'])->name('paymentProcess');
Route::match(['GET','POST'],'/payment/callback', [ControllersPaymentController::class, 'callBack']);

// ========================== Admin Routes ==========================
Route::middleware(['auth', 'verified', 'admin'])->prefix('dashboard')->name('dashboard.')->group(function () {
    // Dashboard Home
    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // Sections Management
    Route::prefix('sections')->name('sections.')->group(function () {
        Route::get('/', [SectionController::class, 'index'])->name('index');
        Route::get('/create', [SectionController::class, 'create'])->name('create');
        Route::post('/create', [SectionController::class, 'store'])->name('store');
        Route::put('/update/{id}', [SectionController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [SectionController::class, 'destroy'])->name('destroy');
    });

    // Orders Management
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/', [OrderController::class, 'index'])->name('index');
        Route::get('/{id}', [OrderController::class, 'show'])->name('show');
        Route::put('/update/{id}', [OrderController::class, 'StatusUpdate'])->name('update');
    });

    // users Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [DashboardController::class, 'users'])->name('index');
    });

    // Products Management
    Route::prefix('products')->name('products.')->group(function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/create', [ProductController::class, 'store'])->name('store');
        Route::put('/update/{id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/destroy/{id}', [ProductController::class, 'destroy'])->name('destroy');
    });

    // Numbers Management
    Route::prefix('numbers')->name('numbers.')->group(function () {
        Route::get('/', [NumberController::class, 'index'])->name('index');
        Route::put('/update/{id}', [NumberController::class, 'update'])->name('update');
    });

    // Shipping Management
    Route::prefix('shipping')->name('shipping.')->group(function () {
        Route::get('/', [ShippingController::class, 'index'])->name('index');
        Route::put('/update/{id}', [ShippingController::class, 'update'])->name('update');
    });

    // Send Emails
    Route::prefix('send')->name('send.')->group(function () {
        Route::get('/send-message', [MessageController::class, 'index'])->name('index');
        Route::post('/send-message', [MessageController::class, 'send'])->name('message');
    });

});

// require __DIR__.'/auth.php';
