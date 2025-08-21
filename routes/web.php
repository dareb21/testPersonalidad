<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlockAcontroller;

Route::get('/', function () {
    return view('welcome');
});


Route::post('blockA', [App\Http\Controllers\BlockAcontroller::class, 'blockA']);