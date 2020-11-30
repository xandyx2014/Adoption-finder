<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\PublicacionAdopcion;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PublicacionAdopcionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publicaciones = PublicacionAdopcion::orderBy('id', 'desc');
        if (request()->has('bin'))
        {
            $publicaciones =  $publicaciones->onlyTrashed();
        }
        $search = request()->input('search');
        $publicaciones = $publicaciones
            ->where('titulo', 'LIKE', "%$search%")
            ->paginate(4)
            ->appends(request()->query());
        return view('adopcion.publicacionAdopcion.index', compact('publicaciones'));
    }
    public function report(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar reporte', 'Publicacion adopcion'));
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1")
        {
            $especies = PublicacionAdopcion::with('mascota', 'solicitudAdopcions', 'denuncias')->get();
        }
        else
        {
            $especies = PublicacionAdopcion::onlyTrashed()->with('mascota', 'solicitudAdopcions', 'denuncias')->get();
        }
        /**/
        return view('adopcion.publicacionAdopcion.report', [
            'especies' => $especies,
            'estado' => $estado
        ]);
    }
    function generatePdf(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Generar reporte pdf', 'Publicacion adopcion'));
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1")
        {
            $especies = PublicacionAdopcion::with('mascota', 'solicitudAdopcions', 'denuncias')->get();
        }
        else
        {
            $especies = PublicacionAdopcion::onlyTrashed()->with('mascota', 'solicitudAdopcions', 'denuncias')->get();
        }
        $pdf = PDF::loadView('adopcion.publicacionAdopcion.pdf', compact('especies'));
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
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario creacion', 'Publicacion adopcion'));
        $mascotas = Mascota::all();
        return view('adopcion.publicacionAdopcion.create', compact('mascotas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|min:0|max:200',
            'descripcion_corta' => 'required|min:0|max:16000000',
            'mascota' => 'required'
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Crear', 'Publicacion adopcion'));
        $publicacion = new PublicacionAdopcion;
        $publicacion->titulo = $request->get('titulo');
        $publicacion->descripcion_corta = $request->get('descripcion_corta');
        $publicacion->mascota_id = $request->get('mascota');
        $publicacion->user_id = auth()->user()->id;
        $publicacion->save();
        return redirect()->route('publicacionAdopcion.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PublicacionAdopcion  $publicacionAdopcion
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Consultar', 'Publicacion adopcion'));
        $publicacion = PublicacionAdopcion::withTrashed()->where('id', $id)
            ->with([
                'user' => function($query) {
                    $query->withTrashed();
                },
                'mascota.raza' => function($query) {
                    $query->withTrashed();
                },
                'mascota.especie' => function($query) {
                    $query->withTrashed();
                },
                'mascota.etiquetas' => function($query) {
                    $query->withTrashed();
                },
                'mascota.imagens' => function($query) {
                    $query->withTrashed();
                },
                ]
            )
            ->first();
        return view('adopcion.publicacionAdopcion.show', compact('publicacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PublicacionAdopcion  $publicacionAdopcion
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario edicion', 'Publicacion adopcion'));
        $mascotas = Mascota::all();
        $publicacion = PublicacionAdopcion::findOrFail($id);
        return view('adopcion.publicacionAdopcion.edit', compact('publicacion', 'mascotas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PublicacionAdopcion  $publicacionAdopcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->input('restore')) {
            dispatch( new \App\Jobs\BitacoraJob('Cambio estado', 'Publicacion adopcion'));
            $especie = PublicacionAdopcion::withTrashed()->find($id)->restore();
            return back();
        }
        $request->validate([
            'titulo' => 'required|min:0|max:200',
            'descripcion_corta' => 'required|min:0|max:16000000',
            'mascota' => 'required'
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Actualizar', 'Publicacion adopcion'));
        $publicacion = PublicacionAdopcion::findOrFail($id);
        $publicacion->update([
            'titulo' => $request->get('titulo'),
            'descripcion_corta' => $request->get('descripcion_corta'),
            'mascota_id' => $request->get('mascota'),
        ]);
        return redirect()->route('publicacionAdopcion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PublicacionAdopcion  $publicacionAdopcion
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especie = PublicacionAdopcion::withTrashed()->find($id);
        $bin = request()->input('bin');
        if ($bin)
        {
            // verificar las dependencias y force delete
            $countTotal = $especie->mascota()->get()->count();
            $countDenuncia = $especie->denuncias()->get()->count();
            $countSolicitud = $especie->solicitudAdopcions()->get()->count();
            if ($countTotal == 0 && $countDenuncia == 0 && $countSolicitud == 0) {
                $especie->forceDelete();
                dispatch( new \App\Jobs\BitacoraJob('Eliminar', 'Publicacion adopcion'));
                if (request()->ajax())
                {
                    return response()->json([
                        "message" => 'Borrado correctamente'
                    ]);
                }
                return back();
            }
            if (request()->ajax())
            {
                $sumatoria = $countTotal + $countDenuncia + $countSolicitud;
                return response()->json([
                    "error" => "Tiene dependencias Total: $sumatoria, Denuncia: $countDenuncia, Solicitud: $countSolicitud, Mascota: $countTotal"
                ]);
            }
            return back()->withErrors(['errorDependencia' => "Especie $especie->nombre tiene dependencias"]);
        }
        dispatch( new \App\Jobs\BitacoraJob('Cambio lo estado', 'Publicacion adopcion'));
        $especie->delete();
        if (request()->ajax())
        {
            return response()->json([
                "message" => 'Borrado correctamente'
            ]);
        }
        return redirect()->route('publicacionAdopcion.index');
    }
}
