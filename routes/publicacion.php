<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoPublicacionController;
use App\Http\Controllers\PublicacionInformativaController;
use App\Http\Controllers\AprobarRechazarPublicacionController;
Route::resources([
    'tipopublicacion' => TipoPublicacionController::class,
    'publicacion' => PublicacionInformativaController::class
]);
Route::resource('aprobar', AprobarRechazarPublicacionController::class)->only(['index', 'show', 'update']);
// TipoPublicacion
Route::get('api/tipopublicacion', [TipoPublicacionController::class, 'indexApi']);
Route::post('tipopublicacion/report', [TipoPublicacionController::class, 'report'])->name('tipopublicacion.report');
Route::post('tipopublicacion/report/pdf', [TipoPublicacionController::class, 'generatePdf'])->name('tipopublicacion.pdf');
// Publicacion
Route::get('api/publicacion', [PublicacionInformativaController::class, 'indexApi']);
Route::delete('photopublicacion/photo/{id}', [PublicacionInformativaController::class, 'imagenDelete'])->name('publicacion.photo.delete');
Route::post('publicacion/report', [PublicacionInformativaController::class, 'report'])->name('publicacion.report');
Route::post('publicacion/report/pdf', [PublicacionInformativaController::class, 'generatePdf'])->name('publicacion.pdf');
Route::post('publicacion/search', [PublicacionInformativaController::class, 'search'])->name('publicacion.search');
Route::get('publicacion/{id}/denuncia', [PublicacionInformativaController::class, 'denuncia'])->name('publicacion.denuncia');
