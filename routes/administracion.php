<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;

Route::resource('user', UserController::class);

Route::get('destroyUser/{id}', [UserController::class, 'destroy']);
// Users
Route::get('api/user', [UserController::class, 'indexApi']);
Route::post('user/report', [UserController::class, 'report'])->name('user.report');
Route::post('user/report/pdf', [UserController::class, 'generatePdf'])->name('user.pdf');

// Rol

Route::resource('rol', RolController::class);
