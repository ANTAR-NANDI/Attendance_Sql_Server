<?php

use App\Http\Controllers\Auth\LoginSessionController;
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

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Employee Registry Management Routes
    Route::get('/setup/employees', [EmployeeMasterController::class, 'index'])->name('employees.setup');
    Route::get('/setup/employees/{id}', [EmployeeMasterController::class, 'show']);
    Route::post('/setup/employees', [EmployeeMasterController::class, 'store']);
    Route::put('/setup/employees/{id}', [EmployeeMasterController::class, 'update']);
    Route::delete('/setup/employees/{id}', [EmployeeMasterController::class, 'destroy']);

    Route::post('/logout', [LoginSessionController::class, 'destroy'])->name('logout');
});
