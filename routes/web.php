<?php

use App\Http\Controllers\BankAccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/', function () {
    return view('welcome');
});

//Route untuk otentikasi dan otorisasi
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['role:admin'])->group(function () {
    //Route untuk user
    Route::get('/', [UserController::class, 'index'])->name('user.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/users/{id}', [UserController::class, 'show'])->name('user.show');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('user.update');
    Route::post('/users', [UserController::class, 'store'])->name('user.store');
    Route::delete('/users/{id}', [UserController::class, 'destroy'])->name('user.destroy');

    //Route untuk rekening
    Route::get('/users/{userId}/bank-account/', [BankAccountController::class, 'index'])->name('user.bank-account.index');
    Route::get('/users/{userId}/bank-account/create', [BankAccountController::class, 'create'])->name('user.bank-account.create');
    Route::get('/users/{userId}/bank-account/{id}/edit', [BankAccountController::class, 'edit'])->name('user.bank-account.edit');
    Route::put('/users/{userId}/bank-account/{id}', [BankAccountController::class, 'update'])->name('user.bank-account.update');
    Route::post('/users/{userId}/bank-account/', [BankAccountController::class, 'store'])->name('user.bank-account.store');
    Route::delete('/users/{userId}/bank-account/{id}', [BankAccountController::class, 'destroy'])->name('user.bank-account.destroy');
});

Route::middleware(['role:user'])->group(function () {
    Route::get('profile', [ProfileController::class, 'index'])->name('profile.index');
});
