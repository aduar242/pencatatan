<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\PackageController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('clients', ClientController::class);
Route::resource('packages', PackageController::class);
Route::post('payments/{client}', [PaymentController::class, 'store'])->name('payments.store');
Route::post('payments/process', [PaymentController::class, 'processPayment'])->name('payments.process');