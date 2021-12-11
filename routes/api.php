<?php

use Illuminate\Http\Request;
use App\Http\Controllers\SubmenuController;
use App\Http\Controllers\TaxController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::get('/items', [SubmenuController::class, 'index']);
Route::get('/tax', [TaxController::class, 'index']);
Route::get('/coupon', [CouponController::class, 'index']);
Route::get('/invoiceno', [InvoiceController::class, 'getInvoiceNo']);
Route::post('/order', [OrderController::class, 'store']);
Route::get('/order', [OrderController::class, 'getOrders']);
Route::put('order/{id}',[OrderController::class, 'update']);
Route::delete('order/{id}',[OrderController::class, 'destroy']);