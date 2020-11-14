<?php

namespace App\Http\Controllers;

use App\Models\Raza;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RazaController extends Controller
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
    public function indexApi()
    {
        $params = request()->input('bin');
        if($params)
        {
            return datatables()
                ->eloquent(Raza::onlyTrashed())
                ->addColumn('btn', 'parametro.raza.actionsBin')
                ->rawColumns(['btn'])
                ->toJson();
        }
        return datatables()
            ->eloquent(Raza::query())
            ->addColumn('btn', 'parametro.raza.actions')
            ->rawColumns(['btn'])
            ->toJson();
    }
    public function index()
    {
        $params = request()->input('bin');
        if ($params) return view('parametro.raza.index', [ 'bin' => true ]);
        return view('parametro.raza.index', [ 'bin' => false]);
    }

    public function report(Request $request)
    {
        $inicio = Carbon::parse($request->get('inicio'))->subDays(1);
        $final = Carbon::parse($request->get('final'))->addDays(1);
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1")
        {
            $especies = Raza::betweenDate($inicio, $final)->get();
        }
        else
        {
            $especies = Raza::onlyTrashed()->betweenDate($inicio, $final)->get();
        }
        /**/
        return view('parametro.raza.report', [
            'especies' => $especies,
            'inicio' => $inicio,
            'final' => $final,
            'estado' => $estado
        ]);
    }
    function generatePdf(Request $request)
    {
        $inicio = Carbon::parse($request->get('inicio'))->subDays(1);
        $final = Carbon::parse($request->get('final'))->addDays(1);
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1")
        {
            $especies = Raza::betweenDate($inicio, $final)->get();
        }
        else
        {
            $especies = Raza::onlyTrashed()->betweenDate($inicio, $final)->get();
        }
        $pdf = PDF::loadView('parametro.raza.pdf', compact('especies'));
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
        return view('parametro.raza.create');
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
            'nombre' => ['required', 'unique:razas', 'max:255'],
            'descripcion' => ['required'],
        ]);
        $especie = new Raza();
        $especie->nombre = $validateData['nombre'];
        $especie->descripcion = $validateData['descripcion'];
        $especie->save();
        return back()->with('success', 'Se ha creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $especie = Raza::withTrashed()->find($id);
        return view('parametro.raza.show', compact('especie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $raza = Raza::withTrashed()->find($id);
        return view('parametro.raza.edit', compact('raza'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->input('restore')) {
            $especie = Raza::withTrashed()->find($id)->restore();
            return back();
        }
        $validateData = $request->validate([
            'nombre' => ['required', 'max:255'],
            'descripcion' => ['required', 'max:255'],
        ]);
        $especie = Raza::withTrashed()->find($id);
        $especie->update($validateData);
        return redirect()->route('raza.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Raza  $raza
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especie = Raza::withTrashed()->find($id);
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
        return redirect()->route('raza.index');
    }
}
