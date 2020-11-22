<?php

use Illuminate\Support\Facades\Route;

Route::view('', 'welcome')->name('init');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('blog', App\Http\Controllers\BlogController::class)->only(['index', 'show']);

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
