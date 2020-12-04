<?php

namespace App\Http\Controllers;

use App\Models\PublicacionInformativa;
use Illuminate\Http\Request;

class AprobarRechazarPublicacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:listar-solicitud-publicacion')->only(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $estado = request()->input('estado') ?? 1;
        $publicaciones = PublicacionInformativa::where('estado', $estado)
            ->paginate(3)
        ->appends(request()->query());
        return view('publicacion.aprobarRechazar.index', compact('publicaciones'));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Aprobar Rechazar Publicacion', 'Publicacion'));
        $estado = $request->input('cambiar');
        $publicacion = PublicacionInformativa::where('id', $id);
        $publicacion->update([
            'estado' => $estado
        ]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
