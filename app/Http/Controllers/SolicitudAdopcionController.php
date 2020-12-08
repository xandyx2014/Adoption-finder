<?php

namespace App\Http\Controllers;

use App\Models\PublicacionAdopcion;
use App\Models\SolicitudAdopcion;
use App\Models\TipoDenuncia;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Str;
use function PHPUnit\Framework\isNull;

class SolicitudAdopcionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:listar-solicitud-adopcion')->only(['index']);
        $this->middleware('permiso:consultar-solicitud-adopcion')->only(['show']);
    }
    public function indexApi()
    {
        $params = request()->input('bin');
        if($params)
        {
            $query = SolicitudAdopcion::onlyTrashed();
            if (Gate::check('no-admin'))
            {
                $query = $query->where('user_id', auth()->user()->id);
            }
            return datatables()
                ->eloquent($query)
                ->editColumn('motivo', function ($request) {
                    return Str::substr($request->motivo, 0 ,15) . "...";
                })
                ->addColumn('btn', 'adopcion.solicitud.actionsBin')
                ->toJson();
        }
        $query = SolicitudAdopcion::with('publicacion_adopcion');
        if (Gate::check('no-admin'))
        {
            $query = SolicitudAdopcion::with('publicacion_adopcion')->where('user_id', auth()->user()->id);
        }
        return datatables()
            ->eloquent($query)
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
        dispatch( new \App\Jobs\BitacoraJob('Mostrar reporte', 'Solicitud adopcion'));
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
        dispatch( new \App\Jobs\BitacoraJob('Generar reporte pdf', 'Solicitud adopcion'));
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
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario creacion', 'Solicitud adopcion'));
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
        dispatch( new \App\Jobs\BitacoraJob('Consultar', 'Solicitud adopcion'));
        $solicitud = SolicitudAdopcion::withTrashed()
            ->where('id', $id)
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
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario edicion', 'Solicitud adopcion'));
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
            dispatch( new \App\Jobs\BitacoraJob('Cambio estado', 'Solicitud adopcion'));
            $especie = SolicitudAdopcion::withTrashed()->find($id)->restore();
            return back();
        }
        $validateData = $request->validate([
            'motivo' => ['required', 'max:255', 'min:20'],
            'descripcion' => ['required', 'max:255', 'min:20'],
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Actualizar', 'Solicitud adopcion'));
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
            /*$value =  SolicitudAdopcion::withTrashed()
                ->where('id', $id )
                ->with('publicacion_adopcion', 'publicacion_adopcion.mascota.adoptador')->first();*/
            // $adoptado = $value->publicacion_adopcion->mascota->adoptador;
            $adoptado = $especie->estado;
            if ($adoptado == 0) {
                $especie->forceDelete();
                dispatch( new \App\Jobs\BitacoraJob('Eliminar', 'Solicitud adopcion'));
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
                    "error" => "Las mascota esta adoptado no se puede eliminar"
                ]);
            }
            return back()->withErrors(['errorDependencia' => "Especie $especie->nombre tiene dependencias"]);
        }
        $especie->delete();
        dispatch( new \App\Jobs\BitacoraJob('Cambio estado', 'Solicitud adopcion'));
        if (request()->ajax())
        {
            return response()->json([
                "message" => 'Borrado correctamente'
            ]);
        }
        return redirect()->route('solicitud.index');
    }
}
