<?php

namespace App\Http\Controllers;

use App\Models\PublicacionInformativa;
use Illuminate\Http\Request;

class PublicacionInformativaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'indexApi']);
    }
    public function indexApi()
    {
        $params = request()->input('bin');
        if($params)
        {
            return datatables()
                ->eloquent(PublicacionInformativa::onlyTrashed())
                ->addColumn('btn', 'publicacion.publicacion.actionsBin')
                ->rawColumns(['btn'])
                ->toJson();
        }
        return datatables()
            ->eloquent(PublicacionInformativa::query())
            ->addColumn('btn', 'publicacion.publicacion.actions')
            ->rawColumns(['btn'])
            ->toJson();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $params = request()->input('bin');
        if ($params) return view('publicacion.publicacion.index', [ 'bin' => true ]);
        return view('publicacion.publicacion.index', [ 'bin' => false]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publicacion.publicacion.create');
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
     * @param  \App\Models\PublicacionInformativa  $publicacionInformativa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       $especie = PublicacionInformativa::withTrashed()
            ->where('id', $id)
            ->with(['denuncias', 'user'])
            ->first();
        return view('publicacion.publicacion.show', compact('especie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PublicacionInformativa  $publicacionInformativa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PublicacionInformativa  $publicacionInformativa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PublicacionInformativa  $publicacionInformativa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
