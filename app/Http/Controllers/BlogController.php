<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\PublicacionInformativa;
use App\Models\TipoDenuncia;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipoDenuncia = TipoDenuncia::all();
        $publicaciones = PublicacionInformativa::where('estado', 1)
            ->orderBy('created_at', 'desc')
            ->with('imagens')
            ->paginate(3);
        return view('blog.index', compact('publicaciones', 'tipoDenuncia'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return "";
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
        $publicacion =  PublicacionInformativa::findOrFail($id);
        if ($publicacion->estado == 0)
        {
            abort(404);
        }
        return view('blog.show', compact('publicacion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validate = request()->validate([
            'descripcion' => ['required', 'min:20','max:200'],
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Crear', 'Denuncia'));
        $denuncia = new Denuncia;
        $denuncia->descripcion = request()->get('descripcion');
        $denuncia->tipo_denuncia_id = request()->get('tipo');
        PublicacionInformativa::findOrFail($id)->denuncias()->save($denuncia);
        return back()->with('denuncia', 'Gracias por enviar tu solicitud');
    }
}
