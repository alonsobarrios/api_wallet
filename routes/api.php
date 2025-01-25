<?php

use App\Http\Controllers\WalletController;
use Illuminate\Support\Facades\Route;

Route::get('checkBalance', [WalletController::class, 'checkBalance']);
Route::post('registerCustomer', [WalletController::class, 'registerCustomer']);
Route::post('rechargeWallet', [WalletController::class, 'rechargeWallet']);
Route::post('makePayment', [WalletController::class, 'makePayment']);
Route::put('confirmPayment', [WalletController::class, 'confirmPayment']);
