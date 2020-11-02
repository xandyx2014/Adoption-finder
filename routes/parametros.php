<?php
use Illuminate\Support\Facades\Route;

Route::resources([
    'especie' => \App\Http\Controllers\EspecieController::class
]);
