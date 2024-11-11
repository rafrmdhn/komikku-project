<?php

use App\Http\Controllers\admin\KomikController;
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

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'authenticate'])->name('login');

Route::get('/', [HomeController::class, 'home'])->name('home');
Route::get('/cart', [HomeController::class, 'cart'])->name('cart');
Route::get('/detail/{id}', [HomeController::class, 'detail']);
Route::post('/addCart', [HomeController::class, 'addCart'])->name('addCart');
Route::post('/cart/update/{id}', [HomeController::class, 'updateQuantity']);
Route::delete('/cart/delete/{id}', [HomeController::class, 'cartDestroy'])->name('cart.delete');
Route::post('/addWishlist', [HomeController::class, 'addWishlist'])->name('addWishlist');
Route::post('/checkout', [HomeController::class, 'checkout'])->name('checkout');
Route::get('/payment', [HomeController::class, 'payment']);

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
});
Route::prefix('/admin')->name('admin.')->group(function () {
    Route::resource('/products', KomikController::class)->names('products');
});

