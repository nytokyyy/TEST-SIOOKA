<?php

use App\Http\Controllers\Auth\UserAuthController;
use App\Http\Controllers\CartManagement\CartController;
use Illuminate\Http\Request;
use Illuminate\Session\Middleware\StartSession;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

/** AUTH START */
Route::controller(UserAuthController::class)->group(function () {
    Route::post('register', 'register');
    Route::post('login', 'login');

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', 'logout');
    });
});
/** AUTH END */

/** CART START */
Route::controller(CartController::class)->prefix('cart')->middleware(StartSession::class)->group(function () {
    Route::get('/', 'show');
    Route::post('/add-product', 'addProduct');
    Route::delete('/remove-product/{product}', 'removeProduct');
});
/** CART END */
