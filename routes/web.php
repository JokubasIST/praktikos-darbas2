<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ReportController;

// Pradinis puslapis
Route::get('/', function () {
    return view('welcome.index');
})->name('home');

//  Tik prisijungus
Route::middleware(['auth'])->group(function () {
    Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
    Route::resource('transactions', TransactionController::class);
    Route::resource('categories', CategoryController::class);
});

//  Dashboard nukreipimas (nebūtinas, jei nenaudoji)
Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('transactions.index'); // arba 'dashboard' jei vis dar naudojamas
    })->name('dashboard');
});
