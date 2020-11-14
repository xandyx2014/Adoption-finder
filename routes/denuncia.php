<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TipoDenunciaController;
// tipo denuncia
Route::resources([
    'tipodenuncia' => TipoDenunciaController::class
]);
Route::get('api/tipodenuncia', [TipoDenunciaController::class, 'indexApi']);
Route::post('tipodenuncia/report', [TipoDenunciaController::class, 'report'])->name('tipodenuncia.report');
Route::post('tipodenuncia/report/pdf', [TipoDenunciaController::class, 'generatePdf'])->name('tipodenuncia.pdf');
