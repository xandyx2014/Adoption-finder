<?php
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\EspecieController;
use \App\Http\Controllers\RazaController;
use \App\Http\Controllers\EtiquetaController;
// Especie
Route::resources([
    'especie' => EspecieController::class
]);
Route::get('api/especie', [EspecieController::class, 'indexApi']);
Route::post('especie/report', [EspecieController::class, 'report'])->name('especie.report');
Route::post('especie/report/pdf', [EspecieController::class, 'generatePdf'])->name('especie.pdf');
// Raza
Route::resources([
    'raza' => RazaController::class
]);
Route::get('api/raza', [RazaController::class, 'indexApi']);
Route::post('raza/report', [RazaController::class, 'report'])->name('raza.report');
Route::post('raza/report/pdf', [RazaController::class, 'generatePdf'])->name('raza.pdf');
// etiqueta
Route::resources([
    'etiqueta' => EtiquetaController::class
]);
Route::get('api/etiqueta', [EtiquetaController::class, 'indexApi']);
Route::post('etiqueta/report', [EtiquetaController::class, 'report'])->name('etiqueta.report');
Route::post('etiqueta/report/pdf', [EtiquetaController::class, 'generatePdf'])->name('etiqueta.pdf');
