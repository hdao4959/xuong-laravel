<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
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



Route::get('/admin', function(){
    return view("admin/dashboard");
})->middleware('isAdmin');


// Auth::routes();
Route::get('auth/login', [LoginController::class, 'showFormLogin'])->name('login');
Route::post('auth/login', [LoginController::class, 'login']);

Route::post('auth/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('auth/register', [RegisterController::class, 'showFormRegister'])->name('register');
Route::post('auth/register', [RegisterController::class, 'register']);

Route::get('home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/', function(){
    $products = Product::query()->latest("id")->limit(4)->get();
    return view("welcome", compact('products'));
})->name('welcome');

Route::get('product/{slug}', [ProductController::class, 'detail'])->name('product.detail');
// Mua bán hàng
Route::post('cart/add', [CartController::class, 'add'])->name('cart.add');
Route::get('cart/list', [CartController::class, 'cartList'])->name('cart.list');
Route::post('order/save', [OrderController::class, 'save'])->name('order.save');
