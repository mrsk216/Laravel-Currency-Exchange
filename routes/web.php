<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CurrencyConverterController;

Route::get('/', [CurrencyConverterController::class, 'index']);
Route::post('/exchange', [CurrencyConverterController::class, 'convert']);

