<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\User;
use Illuminate\Http\Request;
use function PHPUnit\Framework\isNull;

class PerfilController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param \App\Models\Perfil $perfil
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Perfil $perfil
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::where('id', auth()->user()->id)->with([
            'perfil'
        ])->first();
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario edicion', 'Perfil'));
        return view('administracion.perfil.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Perfil $perfil
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $id;
        $user = User::findOrFail($id);
        if ($user->perfil == null) {
            $perfil = new Perfil;
            $perfil->apellidos = $request->get('apellidos') ?? '';
            $perfil->apodo = $request->get('apodo') ?? '';
            $perfil->telefono = $request->get('telefono') ?? '';
            $perfil->about = $request->get('about') ?? '';
            return back()->with('success', 'Actualizado correctamente');
        }
        $user->perfil->update([
            'apellidos' => $request->get('apellidos') ?? ' ',
            'apodo' => $request->get('apodo') ?? ' ',
            'telefono' => $request->get('telefono') ?? ' ',
            'about' => $request->get('about') ?? ' ',
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Actualizar', 'Perfil'));
        return back()->with('success', 'Actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Perfil $perfil
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
