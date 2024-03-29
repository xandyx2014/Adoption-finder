<?php

namespace App\Http\Controllers;

use App\Models\TipoDenuncia;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TipoDenunciaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:listar-tipo-denuncia')->only(['index']);
        $this->middleware('permiso:consultar-tipo-denuncia')->only(['show']);
    }
    public function indexApi()
    {
        $params = request()->input('bin');
        if($params)
        {
            return datatables()
                ->eloquent(TipoDenuncia::onlyTrashed())
                ->addColumn('btn', 'denuncia.tipoDenuncia.actionsBin')
                ->rawColumns(['btn'])
                ->toJson();
        }
        return datatables()
            ->eloquent(TipoDenuncia::query())
            ->addColumn('btn', 'denuncia.tipoDenuncia.actions')
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
        if ($params) return view('denuncia.tipoDenuncia.index', [ 'bin' => true ]);
        return view('denuncia.tipoDenuncia.index', [ 'bin' => false]);
    }
    public function report(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar reporte', 'Tipo denuncia'));
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1")
        {
            $especies = TipoDenuncia::all();
        }
        else
        {
            $especies = TipoDenuncia::onlyTrashed()->get();
        }
        /**/
        return view('denuncia.tipoDenuncia.report', [
            'especies' => $especies,
            'estado' => $estado
        ]);
    }
    function generatePdf(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Generar reporte pdf', 'Tipo denuncia'));
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1")
        {
            $especies = TipoDenuncia::all();
        }
        else
        {
            $especies = TipoDenuncia::onlyTrashed()->get();
        }
        $pdf = PDF::loadView('denuncia.tipoDenuncia.pdf', compact('especies'));
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
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario creacion', 'Tipo denuncia'));
        return view('denuncia.tipoDenuncia.create');
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
            'tipo' => ['required', 'unique:tipo_denuncias', 'max:100'],
            'descripcion' => ['required', 'max:200'],
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Crear', 'Tipo denuncia'));
        $especie = new TipoDenuncia();
        $especie->tipo = $validateData['tipo'];
        $especie->descripcion = $validateData['descripcion'];
        $especie->save();
        return back()->with('success', 'Se ha creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoDenuncia  $tipoDenuncia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Consultar', 'Tipo denuncia'));
        $especie = TipoDenuncia::withTrashed()->find($id);
        return view('denuncia.tipoDenuncia.show', compact('especie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoDenuncia  $tipoDenuncia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario edicion', 'Tipo denuncia'));
        $especie = TipoDenuncia::withTrashed()->find($id);
        return view('denuncia.tipoDenuncia.edit', compact('especie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoDenuncia  $tipoDenuncia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->input('restore')) {
            dispatch( new \App\Jobs\BitacoraJob('Cambio estado', 'Tipo denuncia'));
            $especie = TipoDenuncia::withTrashed()->find($id)->restore();
            return back();
        }
        $validateData = $request->validate([
            'tipo' => ['required', 'max:100'],
            'descripcion' => ['required', 'max:200'],
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Actualizar', 'Tipo denuncia'));
        $especie = TipoDenuncia::withTrashed()->find($id);
        $especie->update($validateData);
        return redirect()->route('tipodenuncia.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoDenuncia  $tipoDenuncia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especie = TipoDenuncia::withTrashed()->find($id);
        $bin = request()->input('bin');
        if ($bin)
        {
            // verificar las dependencias y force delete
            $countTotal = $especie->denuncias()->get()->count();
            if ($countTotal == 0) {
                $especie->forceDelete();
                dispatch( new \App\Jobs\BitacoraJob('Eliminar', 'Tipo denuncia'));
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
        dispatch( new \App\Jobs\BitacoraJob('Cambio estado', 'Tipo denuncia'));
        if (request()->ajax())
        {
            return response()->json([
                "message" => 'Borrado correctamente'
            ]);
        }
        return redirect()->route('tipodenuncia.index');
    }
}
