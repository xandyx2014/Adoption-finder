<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\ImagenMascotaController;
Route::resources([
    'mascota' => MascotaController::class
]);
Route::resource( 'imagenMascota', ImagenMascotaController::class);
/*Route::get('mascota/{id}', [MascotaController::class, 'destroy'])->name('mascota.destroy');*/
Route::delete('mascota/photo/{id}', [MascotaController::class, 'imageDelete'])->name('mascota.photo.delete');
Route::post('mascota/report', [MascotaController::class, 'report'])->name('mascota.report');
Route::post('mascota/report/pdf', [MascotaController::class, 'generatePdf'])->name('mascota.pdf');
