<?php
use Illuminate\Support\Facades\Route;

Route::resources([
    'especie' => \App\Http\Controllers\EspecieController::class
]);

Route::get('api/especie', function() {
    return datatables()
        ->eloquent(App\Models\Especie::query()->orderBy('id', 'desc'))
        ->addColumn('btn', 'parametro.especie.actions')
        ->rawColumns(['btn'])
        ->toJson();
});

