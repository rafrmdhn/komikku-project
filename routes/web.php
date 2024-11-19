<?php

use App\Http\Controllers\admin\KomikController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
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

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/detail/{id}', [HomeController::class, 'detail'])->name('detail');
Route::post('/addCart', [HomeController::class, 'addCart'])->name('addCart');
Route::post('/cart/update/{id}', [HomeController::class, 'updateQuantity']);
Route::delete('/cart/delete/{id}', [HomeController::class, 'cartDestroy'])->name('cart.delete');
Route::post('/addWishlist', [HomeController::class, 'addWishlist'])->name('addWishlist');
Route::delete('/remove-wishlist', [HomeController::class, 'removeWishlist'])->name('removeWishlist');
Route::post('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::get('/payment', [HomeController::class, 'payment']);
Route::get('/daftar-komik', [HomeController::class, 'listKomik'])->name('daftar.komik');
Route::get('/search', [HomeController::class, 'search'])->name('search');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});
Route::prefix('/admin')->name('admin.')->group(function () {
    Route::resource('/products', KomikController::class)->names('products');
});

