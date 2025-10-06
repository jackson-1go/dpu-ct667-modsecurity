<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('main');
});
Route::get('/about', function () {
    return view('about');
});
Route::get('/myresearch', function () {
    return view('myresearch');
});
Route::get('/reference', function () {
    return view('reference');
});
