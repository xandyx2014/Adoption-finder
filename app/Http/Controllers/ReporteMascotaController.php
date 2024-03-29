<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReporteMascotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:generar-reporte-mascota');
    }

    public function index()
    {
        $mascotas = Mascota::all();
        if(Gate::check('no-admin'))
        {
            $mascotas = $mascotas->where('user_id', auth()->user()->id);
        }
        dispatch( new \App\Jobs\BitacoraJob('Mostrar parametros de reporte', 'Reporte mascota'));
        return view('reporte.reporteMascota.index', compact('mascotas'));
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
        $user = $request->get('user');
        $adoptador = $request->get('adoptador');
        $publicacion = $request->get('publicacion');
        $denuncia = $request->get('denuncia');
        $solicitud = $request->get('solicitud');
        $query = Mascota::where('id', $request->get('mascota'))
            ->with([
                'raza' => function ($query) {
                    $query->withTrashed();
                },
                'etiquetas' => function ($query) {
                    $query->withTrashed();
                },
                'especie' => function ($query) {
                    $query->withTrashed();
                },
            ]);
        if ($user == 1) {
            $query = $query->with([
                'user' => function ($query) {
                    $query->withTrashed();
                }
            ]);
        }
        if ($adoptador == 1) {
            $query = $query->with([
                'propetario' => function ($query) {
                    $query->withTrashed();
                }
            ]);
        }
        if ($publicacion == 1) {
            $query = $query->with([
                'publicacionAdopcions' => function ($query) {
                    $query->withTrashed();
                }
            ]);
        }

        $mascota = $query->first();
        dispatch( new \App\Jobs\BitacoraJob('Mostrar reporte', 'Reporte mascota'));
        return view('reporte.reporteMascota.report',
            compact('mascota', 'user', 'adoptador', 'publicacion', 'solicitud', 'denuncia')
        );
    }
    public function pdf(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Generar reporte pdf', 'Reporte mascota'));
        $user = $request->get('user');
        $adoptador = $request->get('adoptador');
        $publicacion = $request->get('publicacion');
        $denuncia = $request->get('denuncia');
        $solicitud = $request->get('solicitud');
         $query = Mascota::where('id', $request->get('mascota'))
            ->with([
                'raza' => function ($query) {
                    $query->withTrashed();
                },
                'etiquetas' => function ($query) {
                    $query->withTrashed();
                },
                'especie' => function ($query) {
                    $query->withTrashed();
                },
            ]);
        if ($user == 1) {
            $query = $query->with([
                'user' => function ($query) {
                    $query->withTrashed();
                }
            ]);
        }
        if ($adoptador == 1) {
            $query = $query->with([
                'propetario' => function ($query) {
                    $query->withTrashed();
                }
            ]);
        }
        if ($publicacion == 1) {
            $query = $query->with([
                'publicacionAdopcions' => function ($query) {
                    $query->withTrashed();
                }
            ]);
        }

        $mascota = $query->first();
        $pdf = PDF::loadView('reporte.reporteMascota.pdf',  compact('mascota', 'user', 'adoptador', 'publicacion', 'solicitud', 'denuncia'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOptions(["isPhpEnabled" => true]);
        return $pdf->stream();
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
        //
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
        //
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
