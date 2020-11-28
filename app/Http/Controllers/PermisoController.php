<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Permiso::orderBy('id', 'desc');
        if (request()->has('search'))
        {
            $q = request()->input('search');
            $query = $query->where('nombre', 'LIKE', "%$q%");
        }
        $permisos = $query->paginate(4)->appends(request()->query());
        return view('administracion.permiso.index', compact('permisos'));
    }
    public function report(Request $request)
    {
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1") {
            $especies = Permiso::all();
        } else {
            $especies = Permiso::onlyTrashed()->get();
        }
        /**/
        return view('administracion.permiso.report', [
            'especies' => $especies,
            'estado' => $estado
        ]);
    }

    function generatePdf(Request $request)
    {
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1") {
            $especies = Permiso::all();
        } else {
            $especies = Permiso::onlyTrashed()->get();
        }
        $pdf = PDF::loadView('administracion.permiso.pdf', compact('especies'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOptions(["isPhpEnabled" => true]);
        return $pdf->stream();
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
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function show(Permiso $permiso)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function edit(Permiso $permiso)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permiso $permiso)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permiso  $permiso
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permiso $permiso)
    {
        //
    }
}
