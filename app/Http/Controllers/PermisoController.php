<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\Rol;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class PermisoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:listar-permiso')->only(['index']);
        $this->middleware('permiso:asignar-permiso')->only(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*if (auth()->user()->can('is-admin'))
        {
            return "soy admin";
        }*/
        // Blade
        // @can('permmiso', 'Ver usuario')
        // @can('is-admin') 'Super admin'
        $query = Rol::orderBy('id', 'desc');
        if (request()->has('search')) {
            $q = request()->input('search');
            $query = $query->where('nombre', 'LIKE', "%$q%");
        }
        $permisos = $query->paginate(4)->appends(request()->query());
        return view('administracion.permiso.index', compact('permisos'));
    }

    public function report(Request $request)
    {
        dispatch(new \App\Jobs\BitacoraJob('Mostrar reporte', 'Permiso'));
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1") {
            $especies = Permiso::all();
        } else {
            $especies = Permiso::onlyTrashed()->get();
        }
        /**/
        return view('administracion.permiso.report', [
            'especies' => $especies,
            'estado' => $estado
        ]);
    }

    function generatePdf(Request $request)
    {
        dispatch(new \App\Jobs\BitacoraJob('Generar reporte', 'Permiso'));
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1") {
            $especies = Permiso::all();
        } else {
            $especies = Permiso::onlyTrashed()->get();
        }
        $pdf = PDF::loadView('administracion.permiso.pdf', compact('especies'));
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
     * @param \App\Models\Permiso $permiso
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dispatch(new \App\Jobs\BitacoraJob('Consultar', 'Permiso'));
        $rol = Rol::where('id', $id)->with('permiso')->first();
        if ($rol->nombre == 'admin') {
            return redirect('home');
        }
        $permisos = Permiso::orderBy('id', 'asc')->get();
        return view('administracion.permiso.show', compact('rol', 'permisos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Permiso $permiso
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Permiso $permiso
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        dispatch(new \App\Jobs\BitacoraJob('Actualizar', 'Permiso'));
        if ($request->has('permisos')) {
            $rol = Rol::findOrFail($id);
            $rol->permiso()->sync($request->get('permisos'));
        }

        return redirect()->route('permiso.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Permiso $permiso
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
