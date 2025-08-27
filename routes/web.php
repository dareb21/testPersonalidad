<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlockAcontroller;

Route::get('/', function () {
    return 'hola desde el server';
});


Route::post('blockA', [App\Http\Controllers\BlockAcontroller::class, 'blockA']);
Route::post('/report', [App\Http\Controllers\BlockAcontroller::class, 'report']);