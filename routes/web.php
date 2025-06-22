<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dasboard');
});
Route::get('/dasboard', function () {
    return view('dasboard');
});
Route::get('/suppliers', function () {
    return view('suppliers.index');
})->name('suppliers.index');
Route::get('/kategoris', function () {
    return view('kategoris.index');
})->name('kategoris.index') ;
Route::get('/produks', function () {
    return view('produks.index');
})->name('produks.index');
Route::get('/penjualan', function () {
    return view('penjualan.index');
})->name('penjualan.index');
Route::get('/stoklog', function () {
    return view('stoklog.index');
})->name('stoklog.index');
Route::get('/shop', function () {
    return view('shop.index');
})->name('shop.index');
Route::get('/regis', function () {
    return view('auth.regis');
})->name('auth.regis');
Route::get('/login', function () {
    return view('auth.login');
})->name('auth.login');
