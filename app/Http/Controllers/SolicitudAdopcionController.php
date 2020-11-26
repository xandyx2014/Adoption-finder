<?php

namespace App\Http\Controllers;

use App\Models\PublicacionAdopcion;
use App\Models\SolicitudAdopcion;
use App\Models\TipoDenuncia;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isNull;

class SolicitudAdopcionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function indexApi()
    {
        $params = request()->input('bin');
        if($params)
        {
            return datatables()
                ->eloquent(SolicitudAdopcion::onlyTrashed())
                ->editColumn('motivo', function ($request) {
                    return Str::substr($request->motivo, 0 ,15) . "...";
                })
                ->editColumn('estado', function ($request) {
                    if ($request->estado)
                    {
                        return "<span class='badge badge-success'>Aceptado</span>";
                    }
                    return "<span class='badge badge-danger'>Pendiente</span>";;
                })
                ->addColumn('btn', 'adopcion.solicitud.actionsBin')
                ->rawColumns(['btn', 'estado'])
                ->toJson();
        }
        return datatables()
            ->eloquent(SolicitudAdopcion::with('publicacion_adopcion'))
            ->editColumn('motivo', function ($request) {
                return Str::substr($request->motivo, 0 ,15) . "...";
            })
            ->editColumn('publicacion_adopcion', function ($request) {
                return "pa";
            })
            ->editColumn('estado', function ($request) {
                if ($request->estado)
                {
                    return "<span class='badge badge-success'>Aceptado</span>";
                }
                return "<span class='badge badge-danger'>Pendiente</span>";;
            })
            ->addColumn('btn', 'adopcion.solicitud.actions')
            ->rawColumns(['btn', 'estado'])
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
        if ($params) return view('adopcion.solicitud.index', [ 'bin' => true ]);
        return view('adopcion.solicitud.index', [ 'bin' => false]);
    }
    public function report(Request $request)
    {
        $estado = $request->get('estado');
        $solicitud = $request->get('solicitud');
        $especies;
        if ($estado == "1")
        {
            $especies = SolicitudAdopcion::where('estado', $solicitud)->with('user')->get();
        }
        else
        {
            $especies = SolicitudAdopcion::onlyTrashed()->where('estado', $solicitud)->with('user')->get();
        }
        /**/
        return view('adopcion.solicitud.report', [
            'especies' => $especies,
            'estado' => $estado,
            'solicitud' => $solicitud
        ]);
    }
    function generatePdf(Request $request)
    {
        $estado = $request->get('estado');
        $solicitud = $request->get('solicitud');
        $especies;
        if ($estado == "1")
        {
            $especies = SolicitudAdopcion::where('estado', $solicitud)->with('user')->get();
        }
        else
        {
            $especies = SolicitudAdopcion::onlyTrashed()->where('estado', $solicitud)->with('user')->get();
        }
        $pdf = PDF::loadView('adopcion.solicitud.pdf', compact('especies'));
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
        return "";
        /*$validateData = $request->validate([
            'tipo' => ['required', 'unique:tipo_denuncias', 'max:100'],
            'descripcion' => ['required', 'max:200'],
        ]);
        $especie = new TipoDenuncia();
        $especie->tipo = $validateData['tipo'];
        $especie->descripcion = $validateData['descripcion'];
        $especie->save();
        return back()->with('success', 'Se ha creado correctamente');*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoDenuncia  $tipoDenuncia
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $solicitud = SolicitudAdopcion::withTrashed()
            ->where('id', $id)
            ->with('publicacion_adopcion', 'publicacion_adopcion.mascota')
            ->first();
        return view('adopcion.solicitud.show', compact('solicitud'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoDenuncia  $tipoDenuncia
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $solicitud = SolicitudAdopcion::withTrashed()
            ->where('id', $id)
            ->with('publicacion_adopcion', 'publicacion_adopcion.mascota')
            ->first();
        return view('adopcion.solicitud.edit', compact('solicitud'));
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
            $especie = SolicitudAdopcion::withTrashed()->find($id)->restore();
            return back();
        }
        $validateData = $request->validate([
            'motivo' => ['required', 'max:255', 'min:20'],
            'descripcion' => ['required', 'max:255', 'min:20'],
        ]);
        $especie = SolicitudAdopcion::withTrashed()->find($id);
        $especie->update($request->all());
        return redirect()->route('solicitud.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoDenuncia  $tipoDenuncia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especie = SolicitudAdopcion::withTrashed()->find($id);
        $bin = request()->input('bin');
        if ($bin)
        {
            // verificar las dependencias y force delete
            $value =  SolicitudAdopcion::withTrashed()
                ->where('id', $id )
                ->with('publicacion_adopcion', 'publicacion_adopcion.mascota.adoptador')->first();
            $adoptado = $value->publicacion_adopcion->mascota->adoptador;
            if ($adoptado == null) {
                $especie->forceDelete();
                if (request()->ajax())
                {
                    return response()->json([
                        "message" => 'Borrado correctamente' . $adoptado
                    ]);
                }
                return back();
            }
            if (request()->ajax())
            {
                return response()->json([
                    "error" => "Las mascota esta adoptado no se puede eliminar" . $adoptado
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
        return redirect()->route('solicitud.index');
    }
}
