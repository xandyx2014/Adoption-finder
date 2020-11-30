<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use App\Models\PublicacionInformativa;
use App\Models\TipoPublicacion;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade as PDF;

class PublicacionInformativaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'indexApi']);
    }

    public function indexApi()
    {
        $params = request()->input('bin');
        if ($params) {
            return datatables()
                ->eloquent(PublicacionInformativa::onlyTrashed())
                ->addColumn('btn', 'publicacion.publicacion.actionsBin')
                ->rawColumns(['btn'])
                ->toJson();
        }
        return datatables()
            ->eloquent(PublicacionInformativa::query())
            ->addColumn('btn', 'publicacion.publicacion.actions')
            ->rawColumns(['btn'])
            ->toJson();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        $tipos = TipoPublicacion::all();
        $params = request()->input('bin');
        // reciclaje
        if ($params) {
            $publicaciones = PublicacionInformativa::onlyTrashed()
                ->orderBy('id', 'desc')->paginate(5);

            return view('publicacion.publicacion.index', [
                'bin' => true,
                'publicaciones' => $publicaciones
            ]);
        }
        $query = PublicacionInformativa::orderBy('id', 'desc');
        if (request()->has('usuario')) {
            if (request()->get('usuario') != "x") {
                $query = $query->where('user_id', request()->get('usuario'));
            }
        }
        if (request()->has('tipo')) {
            if (request()->get('tipo') != "x") {
                $query = $query->where('tipo_publicacion_id', request()->get('tipo'));
            }
        }
        if (request()->has('desde')) {
            if (request()->get('desde') != null) {
                $query = $query->whereBetween('created_at', [request()->get('desde'), Carbon::now()]);
            }
        }

        if (request()->has('search')) {
            if (request()->get('search') != null) {
                $q = request()->get('search');
                $query = $query->where('titulo', 'LIKE', "%$q%");
            }
        }


        $query = $query->paginate(4);
        return view('publicacion.publicacion.index', [
            'bin' => false,
            'users' => $users,
            'publicaciones' => $query,
            'tipos' => $tipos
        ]);
    }

    public function report(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar reporte', 'Publicacion informativa'));
        $estado = $request->get('estado');
        $estadoPublicacion = $request->get('estadoPublicacion');
        $especies;
        if ($estado == "1") {
            $especies = PublicacionInformativa::all()->where('estado', $estadoPublicacion);
        } else {
            $especies = PublicacionInformativa::onlyTrashed()->where('estado', $estadoPublicacion)->get();
        }
        /**/
        return view('publicacion.publicacion.report', [
            'especies' => $especies,
            'estado' => $estado,
            'estadoPublicacion' => $estadoPublicacion
        ]);
    }

    function generatePdf(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Generar reporte pdf', 'Publicacion informativa'));
        $estado = $request->get('estado');
        $estadoPublicacion = $request->get('estadoPublicacion');
        $especies;
        if ($estado == "1") {
            $especies = PublicacionInformativa::all()->where('estado', $estadoPublicacion);
        } else {
            $especies = PublicacionInformativa::onlyTrashed()->where('estado', $estadoPublicacion)->get();
        }
        $pdf = PDF::loadView('publicacion.publicacion.pdf', compact('especies'));
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
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario creacion', 'Publicacion informativa'));
        $tipoPublicacion = TipoPublicacion::all();
        return view('publicacion.publicacion.create', [
            'tipos' => $tipoPublicacion,
        ]);
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
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'titulo' => 'required|min:0|max:200',
            'subtitulo' => 'required|min:0|max:150',
            'tipoPublicacion' => 'required'
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Crear', 'Publicacion informativa'));
        $publicacion = new PublicacionInformativa;
        $publicacion->titulo = $request->get('titulo');
        $publicacion->subtitulo = $request->get('subtitulo');
        $publicacion->cuerpo = $request->get('cuerpo');
        $publicacion->user_id = auth()->user()->id;
        $publicacion->tipo_publicacion_id = $request->get('tipoPublicacion');
        $publicacion->save();
        $imagen = $request->file('image');
        $url = Storage::disk('public')->put('', $imagen);
        $imagen = new Imagen;
        $imagen->url = $url;
        $publicacion->imagens()->save($imagen);
        return redirect()->route('publicacion.index');
    }

    public function photo($id)
    {
        $imagen = request()->file('photo');
        $url = Storage::disk('public')->put('', $imagen);
        $imagen = new Imagen;
        $imagen->url = $url;
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\PublicacionInformativa $publicacionInformativa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Consultar', 'Publicacion informativa'));
        $especie = PublicacionInformativa::withTrashed()
            ->where('id', $id)
            ->with([
                'denuncias' => function($query) {
                    $query->withTrashed();
                },
                'user' => function($query) {
                    $query->withTrashed();
                },
                'imagens'
            ])
            ->first();
        return view('publicacion.publicacion.show', compact('especie'));
    }

    public function denuncia($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Consultar', 'Denuncia'));
        $denuncias = PublicacionInformativa::withTrashed()
            ->where('id', $id)
            ->first()
            ->denuncias()
            ->with('tipoDenuncia')->paginate(4);
        return view('publicacion.publicacion.denuncia', [
            'denuncias' => $denuncias,
            'id' => $id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\PublicacionInformativa $publicacionInformativa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario edicion', 'Publicacion informativa'));
        $tipoPublicacion = TipoPublicacion::all();
        $especie = PublicacionInformativa::withTrashed()
            ->where('id', $id)
            ->with(['denuncias', 'user', 'imagens', 'tipoPublicacion'])
            ->first();
        return view('publicacion.publicacion.edit', [
            'especie' => $especie,
            'tipos' => $tipoPublicacion
        ]);
    }

    public function imagenDelete(Request $request, $id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Eliminar imagen', 'Publicacion informativa'));
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
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\PublicacionInformativa $publicacionInformativa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if ($request->input('restore')) {
            dispatch( new \App\Jobs\BitacoraJob('Cambiar estado', 'Publicacion informativa'));
            $especie = PublicacionInformativa::withTrashed()->find($id)->restore();
            return back();
        }
        $validateData = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'titulo' => 'required|min:0|max:200',
            'subtitulo' => 'required|min:0|max:150',
            'cuerpo' => 'required',
            'tipo_publicacion_id' => 'required'
        ]);
        $especie = PublicacionInformativa::withTrashed()->find($id);
        if ($request->hasFile('image')) {
            // borrar imagen
            $especieImagen = $especie->imagens()->first();
            if (!empty($especieImagen)) {
                $imagen = Imagen::withTrashed()->where('id', $especieImagen->id)->first();
                return $imagen->url;
                if ($especieImagen->url != 'default.jpg') {
                    Storage::disk('public')->delete($imagen->url);
                }
                dispatch( new \App\Jobs\BitacoraJob('Eliminar imagen', 'Publicacion informativa'));
                $imagen->delete();
            }

            // agregar imagen
            $newImage = $request->file('image');
            $url = Storage::disk('public')->put('', $newImage);
            $newImage = new Imagen;
            $newImage->url = $url;
            $especie->imagens()->save($newImage);
        }

        $especie->update($request->all());
        dispatch( new \App\Jobs\BitacoraJob('Actualizar', 'Publicacion informativa'));
        return redirect()->route('publicacion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\PublicacionInformativa $publicacionInformativa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especie = PublicacionInformativa::withTrashed()->find($id);
        $bin = request()->input('bin');
        if ($bin) {
            // verificar las dependencias y force delete
            $countTotal = $especie->denuncias()->get()->count();
            $countTotalImagen = $especie->imagens()->get()->count();
            if ($countTotal == 0 || $countTotalImagen == 0) {
                dispatch( new \App\Jobs\BitacoraJob('Eliminar', 'Publicacion informativa'));
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
        dispatch( new \App\Jobs\BitacoraJob('Cambio estado', 'Publicacion informativa'));
        $especie->delete();
        if (request()->ajax()) {
            return response()->json([
                "message" => 'Borrado correctamente'
            ]);
        }
        return redirect()->route('publicacion.index');
    }
}
