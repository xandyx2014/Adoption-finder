<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MascotaController;
Route::resources([
    'mascota' => MascotaController::class
]);
Route::delete('mascota/photo/{id}', [MascotaController::class, 'imageDelete'])->name('mascota.photo.delete');
