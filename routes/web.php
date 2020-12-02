<?php

use Illuminate\Support\Facades\Route;

Route::view('', 'welcome')->name('init');
Route::view('faqs', 'faqs')->name('fasqs');
Route::view('acercaDeNosotros', 'nosotros')->name('nosotros');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::resource('blog', App\Http\Controllers\BlogController::class)->only(['index', 'show', 'destroy']);
Route::resource('finder', App\Http\Controllers\AdoptionFinderController::class)->only(['index', 'show', 'store', 'destroy']);
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

