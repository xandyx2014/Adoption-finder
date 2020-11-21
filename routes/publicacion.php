<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoPublicacionController;
use App\Http\Controllers\PublicacionInformativaController;
Route::resources([
    'tipopublicacion' => TipoPublicacionController::class,
    'publicacion' => PublicacionInformativaController::class
]);
// TipoPublicacion
Route::get('api/tipopublicacion', [TipoPublicacionController::class, 'indexApi']);
Route::post('tipopublicacion/report', [TipoPublicacionController::class, 'report'])->name('tipopublicacion.report');
Route::post('tipopublicacion/report/pdf', [TipoPublicacionController::class, 'generatePdf'])->name('tipopublicacion.pdf');
// Publicacion
Route::get('api/publicacion', [PublicacionInformativaController::class, 'indexApi']);
Route::delete('photopublicacion/photo/{id}', [PublicacionInformativaController::class, 'imagenDelete'])->name('publicacion.photo.delete');
