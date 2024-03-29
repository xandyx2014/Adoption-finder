<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\PublicacionAdopcion;
use App\Models\PublicacionInformativa;
use App\Models\TipoDenuncia;
use App\Models\TipoPublicacion;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class DenunciaController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:listar-denuncia')->only(['index']);
        $this->middleware('permiso:consultar-denuncia')->only(['show']);
    }

    public function index()
    {
        // return Denuncia::all();
        $tipoDenuncia = TipoDenuncia::all();
        $tipo = request()->input('tipo') ?? 1;
        $alias = PublicacionInformativa::class;
        if ($tipo != 1) {
            $alias = PublicacionAdopcion::class;
        }
        $query = Denuncia::where('denunciable_type', $alias);
        if (request()->has('bin')) {
            $query = Denuncia::onlyTrashed();
        }
        if (request()->has('tipo_denuncia') && request()->input('tipo_denuncia') != "") {
            $tipoId = request()->input('tipo_denuncia');
            $query = $query->where('tipo_denuncia_id', $tipoId);
        }
        $query = $query->orderBy('id', 'desc')->with(['tipoDenuncia' => function ($query) {
            $query->withTrashed();
        }])->paginate(3)
            ->appends(request()->query());
        return view('denuncia.denuncia.index', [
            'denuncias' => $query,
            'tipoDenuncia' => $tipoDenuncia
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
     * @param \App\Models\Denuncia $denuncia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dispatch(new \App\Jobs\BitacoraJob('Consultar denuncia', 'Denuncia'));
        $denuncia = Denuncia::withTrashed()->where('id', $id)->first();
        $tipo = TipoDenuncia::withTrashed()->get();
        return view('denuncia.denuncia.show', compact('denuncia', 'tipo'));
    }

    public function report(Request $request)
    {
        dispatch(new \App\Jobs\BitacoraJob('Mostrar reporte', 'Denuncia'));
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1") {
            $especies = Denuncia::all();
        } else {
            $especies = Denuncia::onlyTrashed()->get();
        }

        return view('denuncia.denuncia.report', [
            'especies' => $especies,
            'estado' => $estado
        ]);
    }

    function generatePdf(Request $request)
    {
        dispatch(new \App\Jobs\BitacoraJob('Generar reporte pdf', 'Denuncia'));
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1") {
            $especies = Denuncia::all();
        } else {
            $especies = Denuncia::onlyTrashed()->get();
        }
        $pdf = PDF::loadView('denuncia.denuncia.pdf', compact('especies'));
        $pdf->setPaper('a4', 'portrait');
        $pdf->setOptions(["isPhpEnabled" => true]);
        return $pdf->stream();
    }

    public function edit($id)
    {
        dispatch(new \App\Jobs\BitacoraJob('Mostrar formulario edicion', 'Denuncia'));
        $denuncia = Denuncia::findOrFail($id);
        $tipo = TipoDenuncia::all();
        return view('denuncia.denuncia.edit', compact('denuncia', 'tipo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Denuncia $denuncia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($request->has('restore')) {
            dispatch(new \App\Jobs\BitacoraJob('Cambiar estado', 'Denuncia'));
            Denuncia::withTrashed()->find($id)->restore();
            return redirect()->route('denuncia.index', [
                'bin' => 1
            ]);
        }
        $request->validate([
            'descripcion' => ['required', 'min:15', 'max:200'],
            'tipo_denuncia_id' => ['required'],
        ]);
        $denuncia = Denuncia::withTrashed()->find($id)->update([
            'descripcion' => $request->get('descripcion'),
            'tipo_denuncia_id' => $request->get('tipo_denuncia_id')
        ]);
        dispatch(new \App\Jobs\BitacoraJob('Actualizar', 'Denuncia'));
        return redirect()->route('denuncia.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Denuncia $denuncia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especie = Denuncia::withTrashed()->find($id);
        $bin = request()->input('bin');
        if ($bin) {
            // verificar las dependencias y force delete
            $countTotal = 0;
            $countTotalImagen = 0;
            if ($countTotal == 0 || $countTotalImagen == 0) {
                dispatch(new \App\Jobs\BitacoraJob('Eliminar', 'Denuncia'));
                $especie->forceDelete();
                if (request()->ajax()) {
                    return response()->json([
                        "message" => 'Borrado correctamente'
                    ]);
                }
                return back();
            }
            if (request()->ajax()) {
                return response()->json([
                    "error" => "$especie->nombre tiene dependencias Total: $countTotal"
                ]);
            }
            return back()->withErrors(['errorDependencia' => "Especie $especie->nombre tiene dependencias"]);
        }
        dispatch(new \App\Jobs\BitacoraJob('Cambiar estado', 'Denuncia'));
        $especie->delete();
        if (request()->ajax()) {
            return response()->json([
                "message" => 'Borrado correctamente'
            ]);
        }
        return redirect()->route('denuncia.index', [
            'tipo' => 1
        ]);
    }
}
