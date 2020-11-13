<?php

namespace App\Http\Controllers;

use App\Models\Raza;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RazaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexApi()
    {
        $params = request()->input('bin');
        if($params)
        {
            return datatables()
                ->eloquent(Raza::onlyTrashed())
                ->addColumn('btn', 'parametro.especie.actionsBin')
                ->rawColumns(['btn'])
                ->toJson();
        }
        return datatables()
            ->eloquent(Raza::query())
            ->addColumn('btn', 'parametro.especie.actions')
            ->rawColumns(['btn'])
            ->toJson();
    }
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function show(Raza $raza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function edit(Raza $raza)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Raza $raza)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Raza $raza)
    {
        //
    }
}
