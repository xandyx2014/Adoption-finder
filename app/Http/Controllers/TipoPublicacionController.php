<?php

namespace App\Http\Controllers;

use App\Models\TipoPublicacion;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TipoPublicacionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:listar-tipo-publicacion')->only(['index']);
        $this->middleware('permiso:consultar-tipo-publicacion')->only(['show']);
    }
    public function indexApi()
    {
        $params = request()->input('bin');
        if($params)
        {
            return datatables()
                ->eloquent(TipoPublicacion::onlyTrashed())
                ->addColumn('btn', 'publicacion.tipoPublicacion.actionsBin')
                ->rawColumns(['btn'])
                ->toJson();
        }
        return datatables()
            ->eloquent(TipoPublicacion::query())
            ->addColumn('btn', 'publicacion.tipoPublicacion.actions')
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
        if ($params) return view('publicacion.tipoPublicacion.index', [ 'bin' => true ]);
        return view('publicacion.tipoPublicacion.index', [ 'bin' => false]);
    }
    public function report(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar reporte', 'Tipo publicacion'));
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1")
        {
            $especies = TipoPublicacion::all();
        }
        else
        {
            $especies = TipoPublicacion::onlyTrashed()->get();
        }
        /**/
        return view('publicacion.tipoPublicacion.report', [
            'especies' => $especies,
            'estado' => $estado
        ]);
    }
    function generatePdf(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Generar reporte', 'Tipo publicacion'));
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1")
        {
            $especies = TipoPublicacion::all();
        }
        else
        {
            $especies = TipoPublicacion::onlyTrashed()->get();
        }
        $pdf = PDF::loadView('publicacion.tipoPublicacion.pdf', compact('especies'));
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
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario creacion', 'Tipo publicacion'));
        return view('publicacion.tipoPublicacion.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validateData = $request->validate([
            'tipo' => ['required', 'unique:tipo_publicacions', 'max:50'],
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Crear', 'Tipo publicacion'));
        $especie = new TipoPublicacion();
        $especie->tipo = $validateData['tipo'];
        $especie->save();
        return back()->with('success', 'Se ha creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $especie = TipoPublicacion::withTrashed()->find($id);
        return view('publicacion.tipoPublicacion.show', compact('especie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $especie = TipoPublicacion::withTrashed()->find($id);
        return view('publicacion.tipoPublicacion.edit', compact('especie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->input('restore')) {
            dispatch( new \App\Jobs\BitacoraJob('Cambio estado', 'Tipo publicacion'));
            $especie = TipoPublicacion::withTrashed()->find($id)->restore();
            return back();
        }
        $validateData = $request->validate([
            'tipo' => ['required', 'max:50'],
        ]);
        $especie = TipoPublicacion::withTrashed()->find($id);
        $especie->update($validateData);
        dispatch( new \App\Jobs\BitacoraJob('Actualizar', 'Tipo publicacion'));
        return redirect()->route('tipopublicacion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especie = TipoPublicacion::withTrashed()->find($id);
        $bin = request()->input('bin');
        if ($bin)
        {
            // verificar las dependencias y force delete
            $countTotal = $especie->publicacionInformativas()->get()->count();
            if ($countTotal == 0) {
                $especie->forceDelete();
                dispatch( new \App\Jobs\BitacoraJob('Eliminar', 'Tipo publicacion'));
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
                return response()->json([
                    "error" => "$especie->nombre tiene dependencias Total: $countTotal"
                ]);
            }
            return back()->withErrors(['errorDependencia' => "Especie $especie->nombre tiene dependencias"]);
        }
        $especie->delete();
        dispatch( new \App\Jobs\BitacoraJob('Cambio estado', 'Tipo publicacion'));
        if (request()->ajax())
        {
            return response()->json([
                "message" => 'Borrado correctamente'
            ]);
        }
        return redirect()->route('tipopublicacion.index');
    }
}
