<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\PublicacionAdopcion;
use App\Models\SolicitudAdopcion;
use App\Models\User;
use Illuminate\Http\Request;

class AprobarRechazarSolicitudController extends Controller
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
    public function index()
    {
        $mascotas = Mascota::all();
        $query = SolicitudAdopcion::orderBy('id', 'desc')->whereHas('publicacion_adopcion.mascota', function ($query) {
            $query->whereNull('deleted_at');
            if (request()->has('mascota_id'))
            {
                $query->where('id', request()->input('mascota_id'));
            }
        })->paginate(4);
        $query = $query->appends(request()->query());
        $solicitudes = $query;
        return view('adopcion.aprobarSolicitud.index', compact('solicitudes', 'mascotas'));
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
    {   // Publicacion Publicacion.mascota User
        $solicitud = SolicitudAdopcion::where('id', $id)
            ->with([
                'publicacion_adopcion' => function($query) {
                    $query->withTrashed();
                },
                'publicacion_adopcion.mascota' => function($query) {
                    $query->withTrashed();
                },
                'publicacion_adopcion.mascota.etiquetas' => function($query) {
                    $query->withTrashed();
                },
                'publicacion_adopcion.mascota.especie' => function($query) {
                    $query->withTrashed();
                },
                'publicacion_adopcion.mascota.raza' => function($query) {
                    $query->withTrashed();
                },
                'publicacion_adopcion.mascota.imagens' => function($query) {
                    $query->withTrashed();
                },
                'user' => function($query) {
                    $query->withTrashed();
                },
                ]
            )
            ->first();
        if ($solicitud == null)
        {
            abort(404);
        }
        $solicitudVerificado = optional($solicitud)->publicacion_adopcion;
        $mascotaVerificado = optional( $solicitudVerificado )->mascota;
        $usuarioVerificado = optional( $solicitud )->user;
        return view('adopcion.aprobarSolicitud.aprobar', compact('solicitud'));
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
        $adoptar = $request->get('adoptar');
        $solicitud = SolicitudAdopcion::findOrFail($id);
        $publicacionAdopncion = PublicacionAdopcion::findOrFail($solicitud->publicacion_adopcion_id);
        $usuarioInteresado = User::findOrFail($solicitud->user_id);
        $id = $publicacionAdopncion->mascota_id;
        $mascota = Mascota::findOrFail($id);
        $propetario = $mascota->propetario_id;

        if ($propetario != null) {
            return back()->withErrors(['igual' => 'La mascota tiene ya un propetario']);
        }
        if ($usuarioInteresado->id == auth()->user()->id) {
            return back()->withErrors(['igual' => 'Persona adoptante es la misma persona']);
        }
        $solicitud->update([
            'estado' => 1
        ]);
        $mascota->update([
            'adoptado' => 1,
            'propetario_id' => $usuarioInteresado->id
        ]);
        return redirect()->route('aprobarSolicitud.index')
            ->with('success', 'Has aceptado a la mascota' . $mascota->nombre);
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
