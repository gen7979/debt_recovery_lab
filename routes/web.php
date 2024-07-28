<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DebtController;

Route::get('/', function () {
    return view('welcome');
});

// 借金返済計算の処理
Route::get('/calculate', [DebtController::class, 'calculate'])->name('calculate');
