<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\PermisoController;
Route::resource('user', UserController::class);

// Route::get('destroyUser/{id}', [UserController::class, 'destroy']);
// Users
Route::get('api/user', [UserController::class, 'indexApi']);
Route::post('user/report', [UserController::class, 'report'])->name('user.report');
Route::post('user/report/pdf', [UserController::class, 'generatePdf'])->name('user.pdf');

// Rol
Route::resource('rol', RolController::class);
Route::post('rol/report', [RolController::class, 'report'])->name('rol.report');
Route::post('rol/report/pdf', [RolController::class, 'generatePdf'])->name('rol.pdf');
// Permiso
Route::resource('permiso', PermisoController::class);
Route::post('permiso/report', [PermisoController::class, 'report'])->name('permiso.report');
Route::post('permiso/report/pdf', [PermisoController::class, 'generatePdf'])->name('permiso.pdf');
