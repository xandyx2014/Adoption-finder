<?php
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\EspecieController;
Route::resources([
    'especie' => EspecieController::class
]);

Route::get('api/especie', [EspecieController::class, 'indexApi']);
Route::post('especie/report', [EspecieController::class, 'report'])->name('especie.report');
Route::post('especie/report/pdf', [EspecieController::class, 'generatePdf'])->name('especie.pdf');
