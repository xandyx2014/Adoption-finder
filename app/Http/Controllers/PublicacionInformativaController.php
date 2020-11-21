<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use App\Models\PublicacionInformativa;
use App\Models\TipoPublicacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class PublicacionInformativaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show', 'indexApi']);
    }
    public function indexApi()
    {
        $params = request()->input('bin');
        if($params)
        {
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
        $params = request()->input('bin');
        if ($params) return view('publicacion.publicacion.index', [ 'bin' => true ]);
        return view('publicacion.publicacion.index', [ 'bin' => false]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoPublicacion = TipoPublicacion::all();
        return view('publicacion.publicacion.create', [
            'tipos' => $tipoPublicacion
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
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'titulo' => 'required|min:0|max:200',
            'subtitulo' => 'required|min:0|max:150',
            'tipoPublicacion' => 'required'
        ]);
        $publicacion = new PublicacionInformativa;
        $publicacion->titulo = $request->get('titulo');
        $publicacion->subtitulo = $request->get('subtitulo');
        $publicacion->cuerpo = $request->get('cuerpo');
        $publicacion->user_id = auth()->user()->id;
        $publicacion->tipo_publicacion_id = $request->get('tipoPublicacion');
        $publicacion->save();
        $imagen = $request->file('image');
        $url =  Storage::disk('public')->put('public', $imagen);
        $imagen = new Imagen;
        $imagen->url = $url;
        $publicacion->imagens()->save($imagen);
        return back();
    }
    public function photo($id)
    {
        $imagen = request()->file('photo');
        $url =  Storage::disk('public')->put('public', $imagen);
        $imagen = new Imagen;
        $imagen->url = $url;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PublicacionInformativa  $publicacionInformativa
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $especie = PublicacionInformativa::withTrashed()
            ->where('id', $id)
            ->with(['denuncias', 'user', 'imagens'])
            ->first();
        return view('publicacion.publicacion.show', compact('especie'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PublicacionInformativa  $publicacionInformativa
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $imagen = Imagen::withTrashed()->where('id', $id)->first();
        Storage::disk('public')->delete($imagen->url);
        $imagen->delete();
        return back();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PublicacionInformativa  $publicacionInformativa
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        if ($request->input('restore')) {
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
        $especie->update($request->all());
        return redirect()->route('publicacion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PublicacionInformativa  $publicacionInformativa
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
