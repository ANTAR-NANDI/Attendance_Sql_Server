<?php

use App\Http\Controllers\Auth\LoginSessionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeMasterController;
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

    // Employee Entry form sits cleanly on the primary landing path
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('dashboard/employees', EmployeeController::class);

    Route::post('/logout', [LoginSessionController::class, 'destroy'])->name('logout');
});
