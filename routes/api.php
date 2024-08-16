<?php

use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\StripeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/auth/login', [UserController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->prefix('auth')->group(function () {
    Route::post('/charge', [StripeController::class, 'add'])->name('api.stripe.create');
    Route::get('/success', [StripeController::class, 'success'])->name('api.stripe.success');
    Route::get('/cancel', [StripeController::class, 'cancel'])->name('api.stripe.cancel');
});
