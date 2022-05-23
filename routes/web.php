<?php

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

Route::get('/', [\App\Http\Controllers\FrontendController::class, 'index']);
Route::get('/view/details/{id}', [\App\Http\Controllers\FrontendController::class, 'details']);
Route::get('/food/view/details/{id}', [\App\Http\Controllers\FrontendController::class, 'foodDetails']);
Route::post('/room/booking', [\App\Http\Controllers\FrontendController::class, 'booking']);
Route::post('/food/order', [\App\Http\Controllers\FrontendController::class, 'foodOrder']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/hotel/address', [App\Http\Controllers\HomeController::class, 'address']);

//RoomController
Route::get('/room/list', [App\Http\Controllers\ProductController::class, 'index']);
Route::post('/room/store', [App\Http\Controllers\ProductController::class, 'store']);
Route::get('/room/delete/{product}', [App\Http\Controllers\ProductController::class, 'destroy']);
Route::get('/room/edit/{product}', [App\Http\Controllers\ProductController::class, 'edit']);
Route::post('/room/update/', [App\Http\Controllers\ProductController::class, 'update']);
Route::get('/room/release/{product}', [App\Http\Controllers\ProductController::class, 'release']);
Route::get('/food/edit/{product}', [App\Http\Controllers\FoodController::class, 'edit']);
Route::post('/food/update', [App\Http\Controllers\FoodController::class, 'update']);

//Orders list
Route::get('/booking/list', [App\Http\Controllers\ProductController::class, 'bookingList']);
Route::get('/food/order/list', [App\Http\Controllers\ProductController::class, 'foodOrderList']);

//FoodController
Route::get('/food/list', [\App\Http\Controllers\FoodController::class, 'index']);
Route::post('/food/store', [App\Http\Controllers\FoodController::class, 'store']);
Route::get('/food/delete/{food}', [App\Http\Controllers\FoodController::class, 'destroy']);
