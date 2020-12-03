<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReporteSeguimientoController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar parametros de reporte', 'Reporte seguimiento mascota'));
        $mascotas = Mascota::all();
        if(Gate::check('no-admin'))
        {
            $mascotas = $mascotas->where('user_id', auth()->user()->id);
        }
        return view('reporte.reporteSeguimiento.index', compact('mascotas'));
    }
    function store(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar reporte', 'Reporte seguimiento mascota'));
        $mascota = $request->get('mascota');
        $user = $request->get('user');
        $adoptador = $request->get('adoptador');
        $etiqueta = $request->get('etiqueta');
        $raza = $request->get('raza');
        $especie = $request->get('especie');
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
                'seguimientos' => function ($query) {
                }
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
        $mascota = $query->first();
        return view('reporte.reporteSeguimiento.report',
            compact('mascota', 'user', 'adoptador', 'etiqueta', 'raza', 'especie')
        );
    }
    function pdf(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Generar reporte pdf', 'Reporte seguimiento mascota'));
        $mascota = $request->get('mascota');
        $user = $request->get('user');
        $adoptador = $request->get('adoptador');
        $etiqueta = $request->get('etiqueta');
        $raza = $request->get('raza');
        $especie = $request->get('especie');
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
                'seguimientos' => function ($query) {
                }
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
        $mascota = $query->first();
        $pdf = PDF::loadView('reporte.reporteSeguimiento.pdf',  compact('mascota', 'user', 'adoptador', 'etiqueta', 'raza', 'especie'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOptions(["isPhpEnabled" => true]);
        return $pdf->stream();
    }
}
