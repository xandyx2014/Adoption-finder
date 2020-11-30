<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Seguimiento;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class SeguimientoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Seguimiento::orderBy('id', 'desc')
            ->with('mascota')
            ->whereHas('mascota', function ($query) {
                $search = request()->input('search');
                return $query->where('nombre', 'LIKE', "%$search%");
            });
        if (request()->has('bin'))
        {
            $query = $query->onlyTrashed();
        }
        if (request()->has('adoptado') && request()->input('adoptado') != "")
        {
            $query = $query->whereHas('mascota', function ($query) {
                $adoptado = request()->input('adoptado');
                return $query->where('adoptado', $adoptado);
            });
        }
        if (request()->has('mascota') && request()->input('mascota') != "")
        {
            $query = $query->whereHas('mascota', function ($query) {
                $adoptado = request()->input('mascota');
                return $query->where('mascota_id', $adoptado);
            });
        }
        $query = $query->paginate(4)
        ->appends(request()->query());
        $seguimientos = $query;
        $mascotas = Mascota::all();
        return view('adopcion.seguimiento.index', compact('seguimientos', 'mascotas'));
    }
    public function report(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar reporte', 'Seguimiento'));
        $estado = $request->get('estado');
        $mascota = $request->get('mascota');
        $especies;
        if ($estado == "1")
        {
            $especies = Seguimiento::all();
            if ($mascota != "")
            {
                $especies = $especies->where('mascota_id', $mascota);
            }
        }
        else
        {
            $especies = Seguimiento::onlyTrashed()->get();
            if ($mascota != "")
            {
                $especies = $especies->where('mascota_id', $mascota);
            }
        }
        // return $especies;
        /**/
        return view('adopcion.seguimiento.report', [
            'especies' => $especies,
            'estado' => $estado,
            'mascota' => $mascota
        ]);
    }
    function generatePdf(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Generar reporte', 'Seguimiento'));
        $estado = $request->get('estado');
        $mascota = $request->get('mascota');
        $especies;
        if ($estado == "1")
        {
            $especies = Seguimiento::all();
            if ($mascota != "")
            {
                $especies = $especies->where('mascota_id', $mascota);
            }
        }
        else
        {
            $especies = Seguimiento::onlyTrashed()->get();
            if ($mascota != "")
            {
                $especies = $especies->where('mascota_id', $mascota);
            }
        }
        $pdf = PDF::loadView('adopcion.seguimiento.pdf', compact('especies'));
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
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario creacion', 'Seguimiento'));
        $mascotas = Mascota::all();
        return view('adopcion.seguimiento.create', compact('mascotas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'puntuacion' => 'required|numeric|min:0|max:200',
            'descripcion' => 'required|min:0|max:150',
            'calidad' => 'required|min:0|max:15',
            'mascota_id' => 'required'
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Crear', 'Seguimiento'));
        $seguimiento = new Seguimiento;
        $seguimiento->puntuacion = $request->get('puntuacion');
        $seguimiento->descripcion = $request->get('descripcion');
        $seguimiento->calidad = $request->get('calidad');
        $seguimiento->mascota_id = $request->get('mascota_id');
        $seguimiento->save();
        return redirect()->route('seguimiento.index');
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Seguimiento $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Consultar', 'Seguimiento'));
        $seguimiento = Seguimiento::withTrashed()->where('id', $id)
            ->with('mascota.raza', 'mascota.especie', 'mascota.etiquetas', 'mascota.imagens')->first();
        return view('adopcion.seguimiento.show', compact('seguimiento'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Seguimiento $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario edicion', 'Seguimiento'));
        $mascotas = Mascota::withTrashed()->get();
        $seguimiento = Seguimiento::withTrashed()->where('id', $id)->first();
        return view('adopcion.seguimiento.edit', compact('mascotas', 'seguimiento'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Seguimiento $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->input('restore')) {
            dispatch( new \App\Jobs\BitacoraJob('Cambio estado', 'Seguimiento'));
            $especie = Seguimiento::withTrashed()->find($id)->restore();
            return back();
        }
        $request->validate([
            'puntuacion' => 'required|numeric|min:0|max:200',
            'descripcion' => 'required|min:0|max:150',
            'calidad' => 'required|min:0|max:15',
            'mascota_id' => 'required'
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Actualizar', 'Seguimiento'));
        $seguimiento = Seguimiento::withTrashed()->where('id', $id)->first();
        $seguimiento->update($request->all());
        return redirect()->route('seguimiento.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Seguimiento $seguimiento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especie = Seguimiento::withTrashed()->find($id);
        $bin = request()->input('bin');
        if ($bin)
        {
            // verificar las dependencias y force delete
            $countTotal = 0;
            if ($countTotal == 0) {
                dispatch( new \App\Jobs\BitacoraJob('Eliminar', 'Seguimiento'));
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
        dispatch( new \App\Jobs\BitacoraJob('Cambio estado', 'Seguimiento'));
        $especie->delete();
        if (request()->ajax())
        {
            return response()->json([
                "message" => 'Borrado correctamente'
            ]);
        }
        return redirect()->route('seguimiento.index');
    }
}
