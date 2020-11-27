<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MascotaController;
use App\Http\Controllers\ImagenMascotaController;
use App\Http\Controllers\PublicacionAdopcionController;
use App\Http\Controllers\SeguimientoController;
use App\Http\Controllers\SolicitudAdopcionController;
use App\Http\Controllers\AprobarRechazarSolicitudController;
Route::resources([
    'mascota' => MascotaController::class,
    'publicacionAdopcion' => PublicacionAdopcionController::class,
    'seguimiento' => SeguimientoController::class,
    'solicitud' => SolicitudAdopcionController::class,
    'aprobarSolicitud' => AprobarRechazarSolicitudController::class
]);
Route::get('mascotadestroy/{id}', [MascotaController::class, 'destroy']);
Route::resource( 'imagenMascota', ImagenMascotaController::class);
Route::delete('mascota/photo/{id}', [MascotaController::class, 'imageDelete'])->name('mascota.photo.delete');
Route::post('mascota/report', [MascotaController::class, 'report'])->name('mascota.report');
Route::post('mascota/report/pdf', [MascotaController::class, 'generatePdf'])->name('mascota.pdf');
Route::post('publicacionAdopcion/report', [PublicacionAdopcionController::class, 'report'])->name('publicacionAdopcion.report');
Route::post('publicacionAdopcion/report/pdf', [PublicacionAdopcionController::class, 'generatePdf'])->name('publicacionAdopcion.pdf');
// seguimiento
Route::post('seguimiento/report', [SeguimientoController::class, 'report'])->name('seguimiento.report');
Route::post('seguimiento/report/pdf', [SeguimientoController::class, 'generatePdf'])->name('seguimiento.pdf');
// solicitud
Route::get('api/solicitud', [SolicitudAdopcionController::class, 'indexApi']);
Route::post('solicitud/report', [SolicitudAdopcionController::class, 'report'])->name('solicitud.report');
Route::post('solicitud/report/pdf', [SolicitudAdopcionController::class, 'generatePdf'])->name('solicitud.pdf');
