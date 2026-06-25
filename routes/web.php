<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/test-db', function () {
    return DB::select('SELECT @@VERSION as version');
});
