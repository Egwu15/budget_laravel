<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\transactionController;


Route::view('/', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::get('addTransaction', [TransactionController::class, 'create'])
    ->middleware(['auth'])
    ->name('addTransaction');

Route::post('addTransaction', 'TransactionController@store')
    ->middleware(['auth'])
    ->name('addNewTransaction');


require __DIR__ . '/auth.php';
