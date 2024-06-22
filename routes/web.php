<?php

use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TransactionController;


Route::view('/', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('transactions', TransactionController::class)
    ->middleware(['auth']);

// Route::post('add', 'TransactionController@store')
//     ->middleware(['auth'])
//     ->name('addNewTransaction');

Route::resource('category', CategoryController::class)
    ->middleware(['auth']);

require __DIR__ . '/auth.php';
