<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use App\Models\Rol;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Rol::orderBy('id', 'desc');
        if (request()->has('bin'))
        {
            $query = $query->onlyTrashed();
        }
        if (request()->has('rol'))
        {
            $rol = request()->input('rol');
            $query = $query->where('nombre', 'LIKE', "%$rol%");
        }
        $roles = $query->paginate(4)->appends(request()->query());
        return view('administracion.rol.index', compact('roles'));
    }
    public function report(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar reporte', 'Rol'));
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1") {
            $especies = Rol::all();
        } else {
            $especies = Rol::onlyTrashed()->get();
        }
        /**/
        return view('administracion.rol.report', [
            'especies' => $especies,
            'estado' => $estado
        ]);
    }

    function generatePdf(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Generar reporte pdf', 'Rol'));
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1") {
            $especies = Rol::all();
        } else {
            $especies = Rol::onlyTrashed()->get();
        }
        $pdf = PDF::loadView('administracion.rol.pdf', compact('especies'));
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
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario creacion', 'Rol'));
        return  view('administracion.rol.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => ['required', 'unique:rols','min:5', 'max:200']
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Crear', 'Rol'));
        Rol::create([
            'nombre' => $request->get('nombre')
        ]);
        return redirect()->route('rol.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Consultar', 'Rol'));
        $rol = Rol::where('id', $id)->withTrashed()->with('permiso')->first();
        $permisos = Permiso::all();
        return view('administracion.rol.show', compact('rol', 'permisos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario edicion', 'Rol'));
        $rol = Rol::findOrFail($id);
        if ($rol->nombre == 'admin') {
            return redirect('home');
        }
        return view('administracion.rol.edit', compact('rol'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->has('restore')) {
            dispatch( new \App\Jobs\BitacoraJob('Cambiar estado', 'Rol'));
            Rol::withTrashed()->find($id)->restore();
            return back();
        }
        if ($request->get('rol') == 'admin') {
            return back();
        }
        $request->validate([
            'rol' => ['required', 'min:5', 'max:200']
        ]);
        $rol = Rol::findOrFail($id);
        $rol->update([
            'nombre' => $request->get('rol')
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Actualizar', 'Rol'));
        return redirect()->route('rol.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especie = Rol::withTrashed()->find($id);
        $bin = request()->input('bin');
        if ($bin) {
            try {
                dispatch( new \App\Jobs\BitacoraJob('Eliminar', 'Rol'));
                $especie->forceDelete();
                if (request()->ajax()) {
                    return response()->json([
                        "message" => 'Borrado correctamente'
                    ]);
                }
                return back();
            } catch (\Illuminate\Database\QueryException  $e) {
                return response()->json([
                    "error" => "$especie->nombre tiene dependencias"
                ]);
            }
        }
        $especie->delete();
        dispatch( new \App\Jobs\BitacoraJob('Cambio estado', 'Rol'));
        if (request()->ajax()) {
            return response()->json([
                "message" => 'Borrado correctamente'
            ]);
        }
        return redirect()->route('rol.index');
    }
}
