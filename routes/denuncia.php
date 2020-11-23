<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoDenunciaController;
use App\Http\Controllers\DenunciaController;
// tipo denuncia
Route::resources([
    'tipodenuncia' => TipoDenunciaController::class,
    'denuncia' => DenunciaController::class
]);
Route::get('api/tipodenuncia', [TipoDenunciaController::class, 'indexApi']);
Route::post('tipodenuncia/report', [TipoDenunciaController::class, 'report'])->name('tipodenuncia.report');
Route::post('tipodenuncia/report/pdf', [TipoDenunciaController::class, 'generatePdf'])->name('tipodenuncia.pdf');
// denuncia
Route::post('denuncia/report', [DenunciaController::class, 'report'])->name('denuncia.report');
Route::post('denuncia/report/pdf', [DenunciaController::class, 'generatePdf'])->name('denuncia.pdf');
