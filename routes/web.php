<?php

use App\Http\Controllers\Auth\LoginSessionController;
use Illuminate\Support\Facades\Route;

// Redirect clean base domain index inquiries straight to login view
Route::get('/', function () {
    return redirect()->route('login');
});

// Structural Routing Definitions For Anonymous Guest Sessions
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginSessionController::class, 'create'])->name('login');
    Route::post('/login', [LoginSessionController::class, 'store'])->name('login.post');
});

// Guarded Enterprise Workspace Infrastructure (Requires Active Authentication State)
Route::middleware('auth')->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::post('/logout', [LoginSessionController::class, 'destroy'])->name('logout');
});
