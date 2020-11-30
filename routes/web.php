<?php

use Illuminate\Support\Facades\Route;

Route::view('', 'welcome')->name('init');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('blog', App\Http\Controllers\BlogController::class)->only(['index', 'show']);
Route::resource('finder', App\Http\Controllers\AdoptionFinderController::class)->only(['index', 'show', 'store', 'destroy']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
