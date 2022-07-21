<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HarvestController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlantTypeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\UserController;
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

Route::get('/dashboard', [DashboardController::class, 'index']);

Route::resource('users', UserController::class);
Route::resource('lands', LandController::class);
Route::resource('plants', PlantTypeController::class);
Route::resource('products', ProductController::class);
Route::resource('payments', PaymentController::class);
Route::get('harvests', [HarvestController::class, 'index']);
Route::get('harvests/limit', [HarvestController::class, 'limit']);
Route::put('harvests/limit', [HarvestController::class, 'updateLimit']);
Route::get('harvests/{id}', [HarvestController::class, 'acc']);
Route::get('harvest/{land}', [LandController::class, 'panen']);
Route::post('harvest/{land}', [LandController::class, 'formPanen']);


Route::get('product/{id}', [HomeController::class, 'detailProduct']);