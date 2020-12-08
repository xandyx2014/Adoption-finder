<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use App\Models\Mascota;
use App\Models\PublicacionInformativa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ImagenMascotaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:listar-galeria-mascota')->only(['index']);
    }

    public function index()
    {
        $query = Mascota::with('imagens');
        if (Gate::check('no-admin'))
        {
            $query = $query->where('user_id', auth()->user()->id);
        }
        $query =  $query->where('adoptado', request()->input('adoptado') ?? 1)
            ->paginate(3)
            ->appends(request()->query());
        $publicaciones = $query;
        return view('adopcion.imagenMascota.index', compact('publicaciones'));
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario edicion', 'Imagen Mascota'));
        $publicacion = Mascota::findOrFail($id);
        return view('adopcion.imagenMascota.edit', compact('publicacion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validateData = $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $mascota = Mascota::findOrFail($id);
        $file = $request->file('file');
        $url =  Storage::disk('public')->put('', $file);
        $image = new Imagen;
        $image->url = $url;
        $mascota->imagens()->save($image);
        dispatch( new \App\Jobs\BitacoraJob('Actualizar', 'Imagen Mascota'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagen = Imagen::withTrashed()->where('id', $id)->first();
        if ($imagen->url != 'default.jpg') {
            Storage::disk('public')->delete($imagen->url);
        }
        $imagen->delete();
        dispatch( new \App\Jobs\BitacoraJob('Eliminar', 'Imagen mascota'));
        return back();
    }
}
