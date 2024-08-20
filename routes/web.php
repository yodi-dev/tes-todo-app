<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('app');
})->name('application');

Route::get('/{vue_capture?}', function () {
    return view('app');
})->where('vue_capture', '[\/\w\.-]*');
