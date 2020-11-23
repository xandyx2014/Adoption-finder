<?php

namespace App\Http\Controllers;

use App\Models\Imagen;
use App\Models\PublicacionInformativa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImagenPublicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publicaciones = PublicacionInformativa::with('imagens')
            ->where('estado', request()->input('estado') ?? 1)
            ->paginate(3)
            ->appends(request()->query());
        return view('publicacion.imagenPublicacion.index', compact('publicaciones'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $publicacion = PublicacionInformativa::findOrFail($id);
        return view('publicacion.imagenPublicacion.edit', compact('publicacion'));
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
        $request->validate([
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $file = $request->file('file');
        $imagen = Imagen::findOrFail($id);
        Storage::disk('public')->delete($imagen->url);
        $url =  Storage::disk('public')->put('', $file);
        $imagen->update([
            'url' => $url
        ]);
        return redirect()->route('imagenPublicacion.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imagen = Imagen::findOrFail($id);
        $imagen->update([
            'url' => 'default.jpg'
        ]);
        return back();
    }
}
