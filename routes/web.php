<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HarvestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlantTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TrackingController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Models\Tracking;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/get-map', [HomeController::class, 'dataMap']);
Route::get('/get-geo', [HomeController::class, 'dataGeo']);

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::resource('users', UserController::class);
Route::resource('lands', LandController::class);
Route::resource('plants', PlantTypeController::class);
Route::get('products/{id}', [ProductController::class, 'jual']);
Route::resource('products', ProductController::class);
Route::resource('payments', PaymentController::class);

//transaksi
Route::get('transactions', [TransactionController::class, 'index']);
Route::post('transactions', [TransactionController::class, 'store']);
Route::post('transactions/confirm', [TransactionController::class, 'update']);
Route::get('transactions/{code}', [TransactionController::class, 'show']);

//order
Route::get('orders', [OrderController::class, 'index']);
Route::post('orders', [OrderController::class, 'store']);
Route::post('orders/confirm', [OrderController::class, 'update']);
Route::get('orders/{code}', [OrderController::class, 'show']);

Route::get('harvests', [HarvestController::class, 'index']);
Route::get('harvests/limit', [HarvestController::class, 'limit']);
Route::put('harvests/limit', [HarvestController::class, 'updateLimit']);
Route::get('harvests/{id}', [HarvestController::class, 'acc']);
Route::get('harvest/{land}', [LandController::class, 'panen']);
Route::post('harvest/{land}', [LandController::class, 'formPanen']);


Route::get('product/{id}', [HomeController::class, 'detailProduct']);
Route::get('cart', [HomeController::class, 'cart']);
Route::get('cart/{id}', [HomeController::class, 'addCart']);
Route::post('cart', [HomeController::class, 'updateCart']);
Route::get('delete-cart/{id}', [HomeController::class, 'deleteCart']);
Route::get('checkout', [HomeController::class, 'checkout']);
Route::post('cart/checkout', [HomeController::class, 'prosesCheckout']);
Route::get('product/tengkulak/{id}', [HomeController::class, 'dataTengkulak']);

Route::resource('traces', TrackingController::class);
