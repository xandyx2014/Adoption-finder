<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\PublicacionAdopcion;
use App\Models\PublicacionInformativa;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class DenunciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipo = request()->input('tipo') ?? 1;
        $alias = PublicacionInformativa::class;
        if ($tipo != 1) {
            $alias = PublicacionAdopcion::class;
        }
        $query = Denuncia::where('denunciable_type', $alias)
            ->paginate(4)
            ->appends(request()->query());
        if (request()->has('bin'))
        {
            $query = Denuncia::onlyTrashed()
                ->paginate(4)
                ->appends(request()->query());
        }
        return view('denuncia.denuncia.index', [
            'denuncias' => $query
        ]);
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
     * @param  \App\Models\Denuncia  $denuncia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $denuncia = Denuncia::withTrashed()->where('id', $id)->first();
        if ($denuncia->denunciable_type == PublicacionInformativa::class)
        {
            return redirect()->route('publicacion.show', $denuncia->denunciable_id);
        }
        // retorna a la mascota
        return view('denuncia.denuncia.showAdop');
    }

    public function report(Request $request)
    {
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1")
        {
            $especies = Denuncia::all();
        }
        else
        {
            $especies = Denuncia::onlyTrashed()->get();
        }

        return view('denuncia.denuncia.report', [
            'especies' => $especies,
            'estado' => $estado
        ]);
    }
    function generatePdf(Request $request)
    {
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1")
        {
            $especies = Denuncia::all();
        }
        else
        {
            $especies = Denuncia::onlyTrashed()->get();
        }
        $pdf = PDF::loadView('denuncia.denuncia.pdf', compact('especies'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOptions(["isPhpEnabled" => true]);
        return $pdf->stream();
    }
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Denuncia  $denuncia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        Denuncia::withTrashed()->find($id)->restore();
        return redirect()->route('denuncia.index', [
            'bin' => 1
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Denuncia  $denuncia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especie = Denuncia::withTrashed()->find($id);
        $bin = request()->input('bin');
        if ($bin)
        {
            // verificar las dependencias y force delete
            $countTotal = 0;
            $countTotalImagen = 0;
            if ($countTotal == 0 || $countTotalImagen == 0) {
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
        return redirect()->route('denuncia.index', [
            'tipo' => 1
        ]);
    }
}
