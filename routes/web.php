<?php

use App\Http\Controllers\admin\BillingController;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\KomikController;
use App\Http\Controllers\admin\ProfileController;
use App\Http\Controllers\admin\UserContoller;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login', [AuthController::class, 'authenticate'])->name('login');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/', [HomeController::class, 'home'])->name('home')->middleware('check.admin');
Route::get('/profile', [AuthController::class, 'profile'])->name('profile')->middleware('check.admin');
Route::put('/profile/update', [AuthController::class, 'update'])->name('profile.update');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart')->middleware('check.admin');
Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('detail')->middleware('check.admin');
Route::post('/addCart', [HomeController::class, 'addCart'])->name('addCart')->middleware(['check.admin', 'role:Customer', 'auth']);
Route::post('/cart/update/{id}', [HomeController::class, 'updateQuantity'])->middleware('check.admin');
Route::delete('/cart/delete/{id}', [HomeController::class, 'cartDestroy'])->name('cart.delete')->middleware('check.admin');
Route::post('/addWishlist', [HomeController::class, 'addWishlist'])->name('addWishlist')->middleware(['check.admin', 'role:Customer']);
Route::delete('/remove-wishlist', [HomeController::class, 'removeWishlist'])->name('removeWishlist')->middleware('check.admin');
Route::post('/checkout', [HomeController::class, 'checkout'])->name('checkout')->middleware(['check.admin', 'role:Customer', 'auth']);
Route::get('/payment/{id}', [HomeController::class, 'payment'])->name('payment')->middleware(['check.admin', 'role:Customer', 'auth']);
Route::post('/process-payment', [HomeController::class, 'processPayment'])->name('process-payment')->middleware(['check.admin', 'role:Customer', 'auth']);
Route::get('/daftar-komik', [HomeController::class, 'listKomik'])->name('daftar.komik')->middleware('check.admin');
Route::get('/search', [HomeController::class, 'search'])->name('search')->middleware('check.admin');
Route::get('/order-list', [HomeController::class, 'orderList'])->name('orderList')->middleware(['check.admin', 'role:Customer', 'auth']);
Route::post('order-list/cancel', [HomeController::class, 'cancelOrder'])->name('order.cancel')->middleware(['check.admin', 'role:Customer', 'auth']);
Route::get('/komik-terbaru', [HomeController::class, 'newestList'])->name('komik.terbaru')->middleware('check.admin');
Route::get('/wishlist', [HomeController::class, 'wishList'])->name('wishList')->middleware(['check.admin', 'role:Customer', 'auth']);

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::prefix('/admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
        Route::resource('/products', KomikController::class)->names('products');
        Route::resource('/billings', BillingController::class)->names('billings');
        Route::resource('/users', UserContoller::class)->names('users');
        Route::resource('/profile', ProfileController::class)->names('profile');
    });
});
