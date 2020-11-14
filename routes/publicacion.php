<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoPublicacionController;
Route::resources([
    'tipopublicacion' => TipoPublicacionController::class
]);
Route::get('api/tipopublicacion', [TipoPublicacionController::class, 'indexApi']);
Route::post('tipopublicacion/report', [TipoPublicacionController::class, 'report'])->name('tipopublicacion.report');
Route::post('tipopublicacion/report/pdf', [TipoPublicacionController::class, 'generatePdf'])->name('tipopublicacion.pdf');
