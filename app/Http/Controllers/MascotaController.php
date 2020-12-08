<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Etiqueta;
use App\Models\Imagen;
use App\Models\Mascota;
use App\Models\Raza;
use App\Models\SolicitudAdopcion;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class MascotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:listar-mascota')->only(['index']);
        $this->middleware('permiso:consultar-mascota')->only(['show']);
        $this->middleware('permiso:editar-mascota')->only(['edit', 'update']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = Mascota::orderBy('created_at', 'desc');
        if (Gate::check('no-admin'))
        {
            // dd('no-admin');
            $query = $query->where('user_id', auth()->user()->id);
        }
        $razas = Raza::all();
        $especies = Especie::all();
        if (request()->input('bin'))
        {
            $query = $query->onlyTrashed();
        }
        if (request()->has('adoptado') && request()->input('adoptado') != "")
        {
            dispatch( new \App\Jobs\BitacoraJob('Buscar mascotas', 'Mascota'));
            $query = $query->where('adoptado', request()->input('adoptado'));
        }
        /*if (request()->has('raza') && request()->input('raza') != "")
        {
            $query = $query->where('raza_id', request()->input('raza'));
        }
        if (request()->has('especie') && request()->input('especie') != "")
        {
            $query = $query->where('especie_id', request()->input('raza'));
        }*/
        if (request()->has('search'))
        {
            dispatch( new \App\Jobs\BitacoraJob('Buscar mascotas', 'Mascota'));
            $nombre = request()->input('search');
            $query = $query->where('nombre', 'LIKE', "%$nombre%");
        }
        $mascotas = $query->paginate(3)
            ->appends(request()->query());
        return view('adopcion.mascota.index', compact('mascotas', 'razas', 'especies'));
    }
    public function report(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Generar reporte mascotas', 'Mascota'));
        $estado = $request->get('estado');
        $adoptado = $request->get('adoptado');
        $especies;
        if ($estado == "1")
        {
            $especies = Mascota::where('adoptado', $adoptado)->get();
        }
        else
        {
            $especies = Mascota::onlyTrashed()->where('adoptado', $adoptado)->get();
        }
        /**/
        return view('adopcion.mascota.report', [
            'especies' => $especies,
            'estado' => $estado,
            'adoptado' => $adoptado
        ]);
    }
    function generatePdf(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Generar Pdf Mascota mascotas', 'Mascota'));
        $estado = $request->get('estado');
        $adoptado = $request->get('adoptado');
        $especies;
        if ($estado == "1")
        {
            $especies = Mascota::where('adoptado', $adoptado)->get();
        }
        else
        {
            $especies = Mascota::onlyTrashed()->where('adoptado', $adoptado)->get();
        }
        $pdf = PDF::loadView('adopcion.mascota.pdf', compact('especies'));
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
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario creacion mascota', 'Mascota'));
        $etiquetas = Etiqueta::all();
        $razas = Raza::all();
        $especies = Especie::all();
        return view('adopcion.mascota.create', [
            'etiquetas' => $etiquetas,
            'razas' => $razas,
            'especies' => $especies
        ]);
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
            'file.*' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'nombre' => 'required|min:0|max:200',
            'color' => 'required|min:0|max:150',
            'descripcion' => 'required|min:0|max:200',
            'tamagno' => 'required|min:0|max:200',
            'salud' => 'required',
            'about' => 'required',
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Guardar mascotas', 'Mascota'));
        $mascota = new Mascota;
        $mascota->nombre = $request->get('nombre');
        $mascota->color = $request->get('color');
        $mascota->raza_id = $request->get('raza');
        $mascota->user_id = auth()->user()->id;
        $mascota->especie_id = $request->get('especie');
        $mascota->descripcion = $request->get('descripcion');
        $mascota->tamagno = $request->get('tamagno');
        $mascota->salud = $request->get('salud');
        $mascota->about = $request->get('about');
        $mascota->save();
        $mascota->etiquetas()->sync($request->get('etiquetas'));
        $imagenes = $request->file('file.*');
        if ($imagenes != null){
            foreach ($imagenes as $img)
            {
                $url =  Storage::disk('public')->put('', $img);
                $imagen = new Imagen;
                $imagen->url = $url;
                $mascota->imagens()->save($imagen);
            }
        }


        return redirect()->route('mascota.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Mascota  $mascota
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Consultar', 'Mascota'));
        $mascota = Mascota::withTrashed()
            ->where('id', $id)
            ->with([
                'user' => function($query) {
                    $query->withTrashed();
                },
                'etiquetas' => function($query) {
                    $query->withTrashed();
                },
                'raza' => function($query) {
                    $query->withTrashed();
                },
                'especie' => function($query) {
                    $query->withTrashed();
                }])
            ->first();
        return view('adopcion.mascota.show', compact('mascota'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Mascota  $mascota
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario edicion', 'Mascota'));
        $mascota = Mascota::where('id', $id)->with([
            'propetario' => function ($query) {
                $query->withTrashed();
            }
        ])->first();
        $etiquetas = Etiqueta::all();
        $razas = Raza::all();
        $especies = Especie::all();
        return view('adopcion.mascota.edit', [
            'etiquetas' => $etiquetas,
            'razas' => $razas,
            'especies' => $especies,
            'mascota' => $mascota
        ]);
    }
    public function imageDelete($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Borrar imagen', 'Mascota'));
        $imagen = Imagen::withTrashed()->where('id', $id)->first();
        if ($imagen->url != 'default.jpg')
        {
            Storage::disk('public')->delete($imagen->url);
        }
        $imagen->delete();
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Mascota  $mascota
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($request->has('restore'))
        {
            Mascota::withTrashed()->find($id)->restore();
            dispatch( new \App\Jobs\BitacoraJob('Cambiar estado', 'Mascota'));
            return back();

        }
        $mascota = Mascota::findOrFail($id);
        $request->validate([
            'nombre' => 'required|min:0|max:200',
            'color' => 'required|min:0|max:150',
            'descripcion' => 'required|min:0|max:200',
            'tamagno' => 'required|min:0|max:200',
            'salud' => 'required',
            'about' => 'required',
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Actualizar', 'Mascota'));
        if (request()->hasFile('file'))
        {
            $imagenes = $request->file('file.*');
            foreach ($imagenes as $img)
            {
                $url =  Storage::disk('public')->put('', $img);
                $imagen = new Imagen;
                $imagen->url = $url;
                $mascota->imagens()->save($imagen);
            }
        }

        $mascota->update([
            'nombre' => $request->get('nombre'),
            'color' => $request->get('color'),
            'descripcion' => $request->get('descripcion'),
            'tamagno' => $request->get('tamagno'),
            'salud' => $request->get('salud'),
            'about' => $request->get('about'),
            'especie_id' => $request->get('especie'),
            'raza_id' => $request->get('raza'),
        ]);
        if ($request->get('propetario') == 0)
        {
            $solicitud = $mascota->publicacionAdopcions()
                ->with(
                    ['solicitudAdopcions' => function($query) {
                        $query->where('estado', 'aceptado');
                    }]
                )
                ->first();
            try {
                $id = collect($solicitud)['solicitud_adopcions'][0]['id'];
                $solicitud = SolicitudAdopcion::findOrFail($id);
                $solicitud->update([
                    'estado' => 'RECHAZADO'
                ]);
            } catch (\Throwable $e)
            {
                abort(404);
            }
            $mascota->update([
                'propetario_id' => null,
                'adoptado' => 0,
            ]);
        }
        $mascota->etiquetas()->sync($request->get('etiquetas'));
        return redirect()->route('mascota.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Mascota  $mascota
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $especie = Mascota::withTrashed()->find($id);
        $bin = request()->input('bin');
        if ($bin)
        {
            if ($especie->adoptado == "1")
            {
                dispatch( new \App\Jobs\BitacoraJob('Eliminar no completado', 'Mascota'));
                return response()->json([
                    "error" => "$especie->nombre ya ha sido adoptado no se puede eliminar"
                ]);
            }
            try {
                $especie->etiquetas()->detach();
                $especie->forceDelete();
                dispatch( new \App\Jobs\BitacoraJob('Eliminar', 'Mascota'));
                if (request()->ajax())
                {
                    return response()->json([
                        "message" => 'Borrado correctamente'
                    ]);
                }
                return back();
            }
            catch (\Illuminate\Database\QueryException  $e) {
                $message = $e->getMessage();
                return response()->json([
                    "error" => "$especie->nombre tiene dependencias"
                ]);
            }


            if (request()->ajax())
            {
                $publicaciones = $counPublicaicones;
                $total = $countTotal + $countTotalImagen + $countSeguimiento + $publicaciones;
                dispatch( new \App\Jobs\BitacoraJob('Eliminar mascota no completado', 'Mascota'));
                return response()->json([
                    "error" => "$especie->nombre tiene dependencias Total: $total, Imagenes: $countTotalImagen, Seguimientos: $countSeguimiento, Publicaciones de adopcion $publicaciones"
                ]);
            }
            return back()->withErrors(['errorDependencia' => "Especie $especie->nombre tiene dependencias"]);
        }
        $especie->delete();
        dispatch( new \App\Jobs\BitacoraJob('Cambiar estado', 'Mascota'));
        if (request()->ajax())
        {
            return response()->json([
                "message" => 'Borrado correctamente'
            ]);
        }
        return redirect()->route('mascota.index');
    }
}
