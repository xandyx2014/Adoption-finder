<?php

namespace App\Http\Controllers;

use App\Models\Etiqueta;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EtiquetaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:listar-etiqueta')->only(['index']);
        $this->middleware('permiso:consultar-etiqueta')->only(['show']);
    }
    public function indexApi()
    {
        $params = request()->input('bin');
        if($params)
        {
            return datatables()
                ->eloquent(Etiqueta::onlyTrashed())
                ->addColumn('btn', 'parametro.etiqueta.actionsBin')
                ->rawColumns(['btn'])
                ->toJson();
        }
        return datatables()
            ->eloquent(Etiqueta::query())
            ->addColumn('btn', 'parametro.etiqueta.actions')
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
        if ($params) return view('parametro.etiqueta.index', [ 'bin' => true ]);
        return view('parametro.etiqueta.index', [ 'bin' => false]);
    }
    public function report(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar reporte', 'Etiqueta'));
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1")
        {
            $especies = Etiqueta::all();
        }
        else
        {
            $especies = Etiqueta::onlyTrashed()->get();
        }
        /**/
        return view('parametro.etiqueta.report', [
            'especies' => $especies,
            'estado' => $estado
        ]);
    }
    function generatePdf(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Generar reporte pdf', 'Etiqueta'));
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1")
        {
            $especies = Etiqueta::all();
        }
        else
        {
            $especies = Etiqueta::onlyTrashed()->get();
        }
        $pdf = PDF::loadView('parametro.etiqueta.pdf', compact('especies'));
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
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario creacion', 'Etiqueta'));
        return view('parametro.etiqueta.create');
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
            'nombre' => ['required', 'unique:etiquetas', 'max:255'],
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Crear', 'Etiqueta'));
        $especie = new Etiqueta();
        $especie->nombre = $validateData['nombre'];
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
        dispatch( new \App\Jobs\BitacoraJob('Consultar', 'Etiqueta'));
        $especie = Etiqueta::withTrashed()->find($id);
        return view('parametro.etiqueta.show', compact('especie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario edicion', 'Etiqueta'));
        $especie = Etiqueta::withTrashed()->find($id);
        return view('parametro.etiqueta.edit', compact('especie'));
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
            dispatch( new \App\Jobs\BitacoraJob('Cambiar estado', 'Etiqueta'));
            $especie = Etiqueta::withTrashed()->find($id)->restore();
            return back();
        }
        $validateData = $request->validate([
            'nombre' => ['required', 'max:15'],
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Actualizar', 'Etiqueta'));
        $especie = Etiqueta::withTrashed()->find($id);
        $especie->update($validateData);
        return redirect()->route('etiqueta.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Etiqueta  $etiqueta
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especie = Etiqueta::withTrashed()->find($id);
        $bin = request()->input('bin');
        if ($bin)
        {
            // verificar las dependencias y force delete
            $countTotal = $especie->mascotas()->get()->count();
            if ($countTotal == 0) {
                dispatch( new \App\Jobs\BitacoraJob('Eliminar', 'Etiqueta'));
                $especie->forceDelete();
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
        dispatch( new \App\Jobs\BitacoraJob('Cambiar estado', 'Etiqueta'));
        $especie->delete();
        if (request()->ajax())
        {
            return response()->json([
                "message" => 'Borrado correctamente'
            ]);
        }
        return redirect()->route('etiqueta.index');
    }
}
