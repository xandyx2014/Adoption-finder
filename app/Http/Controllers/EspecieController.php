<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class EspecieController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:listar-especie')->only(['index']);
        $this->middleware('permiso:consultar-especie')->only(['show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexApi()
    {
        $params = request()->input('bin');
        if($params)
        {
            return datatables()
                ->eloquent(Especie::onlyTrashed())
                ->addColumn('btn', 'parametro.especie.actionsBin')
                ->rawColumns(['btn'])
                ->toJson();
        }
        return datatables()
            ->eloquent(Especie::query())
            ->addColumn('btn', 'parametro.especie.actions')
            ->rawColumns(['btn'])
            ->toJson();
    }
    public function index()
    {
        $params = request()->input('bin');
        if ($params) return view('parametro.especie.index', [ 'bin' => true ]);
        return view('parametro.especie.index', [ 'bin' => false]);
    }
    public function report(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar reporte', 'Especie'));
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1")
        {
            $especies = Especie::all();
        }
        else
        {
            $especies = Especie::onlyTrashed()->get();
        }
        /**/
        return view('parametro.especie.report', [
            'especies' => $especies,
            'estado' => $estado
        ]);
    }
    function generatePdf(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Generar reporte pdf', 'Especie'));
        $inicio = Carbon::parse($request->get('inicio'))->subDays(1);
        $final = Carbon::parse($request->get('final'))->addDays(1);
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1")
        {
            $especies = Especie::betweenDate($inicio, $final)->get();
        }
        else
        {
            $especies = Especie::onlyTrashed()->betweenDate($inicio, $final)->get();
        }
        $pdf = PDF::loadView('parametro.especie.pdf', compact('especies'));
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
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario creacion', 'Especie'));
        return view('parametro.especie.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Crear', 'Especie'));
        $validateData = $request->validate([
            'nombre' => ['required', 'unique:especies', 'max:255'],
            'descripcion' => ['required'],
        ]);
        $especie = new Especie();
        $especie->nombre = $validateData['nombre'];
        $especie->descripcion = $validateData['descripcion'];
        $especie->save();
        return back()->with('success', 'Se ha creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Consultar', 'Especie'));
        $especie = Especie::withTrashed()->find($id);
        return view('parametro.especie.show', compact('especie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario edicion', 'Especie'));
        $especie = Especie::withTrashed()->find($id);
        return view('parametro.especie.edit', compact('especie'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Actualizar', 'Especie'));
        if ($request->input('restore')) {
            $especie = Especie::withTrashed()->find($id)->restore();
            return back();
        }
        $validateData = $request->validate([
            'nombre' => ['required', 'max:255'],
            'descripcion' => ['required', 'max:255'],
        ]);
        $especie = Especie::withTrashed()->find($id);
        $especie->update($validateData);
        return redirect()->route('especie.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Especie  $especie
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especie = Especie::withTrashed()->find($id);
        $bin = request()->input('bin');
        if ($bin)
        {
            // verificar las dependencias y force delete
            $countTotal = $especie->mascotas()->get()->count();
            if ($countTotal == 0) {
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
        $especie->delete();
        if (request()->ajax())
        {
            return response()->json([
                "message" => 'Borrado correctamente'
            ]);
        }
        return redirect()->route('especie.index');
    }
}
