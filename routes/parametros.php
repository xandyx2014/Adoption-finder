<?php
use Illuminate\Support\Facades\Route;

Route::resources([
    'especie' => \App\Http\Controllers\EspecieController::class
]);

Route::get('api/especie', function() {
    $params = request()->input('bin');
    if($params)
    {
        return datatables()
            ->eloquent(App\Models\Especie::onlyTrashed())
            ->addColumn('btn', 'parametro.especie.actionsBin')
            ->rawColumns(['btn'])
            ->toJson();
    }
    return datatables()
        ->eloquent(App\Models\Especie::query())
        ->addColumn('btn', 'parametro.especie.actions')
        ->rawColumns(['btn'])
        ->toJson();
});

