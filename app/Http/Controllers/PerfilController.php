<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
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
        dispatch( new \App\Jobs\BitacoraJob('Actualizar', 'User'));
        $user = User::findOrFail(auth()->user()->id);
        if($request->get('password') == null)
        {
            // actualizar solo nombre
            if ($user->email == $request->get('email'))
            {
                $validateRequest = $request->validate([
                    'name' => ['required', 'string', 'max:255']
                ]);
                $user->update($validateRequest);
                return back()->with('user', 'Se ha actualizado tu usuario');
            }
            // actualizar email
            $validateRequest = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);


            $user->update($validateRequest);
            return back()->with('user', 'Se ha actualizado tu usuario');
        }
        if ($user->email == $request->get('email'))
        {
            $validateRequest = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user->update([
                'name' => $request->get('name'),
                'password' => Hash::make($request->get('password'))
            ]);
            return back()->with('user', 'Se ha actualizado tu usuario');
        }
        if ($user->email != $request->get('email'))
        {
            $validateRequest = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user->update([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password'))
            ]);
            return back()->with('user', 'Se ha actualizado tu usuario');
        }
        // si quiere actualizar contraseña

        return back()->with('user', 'Se ha actualizado tu usuario');
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
        $user = User::findOrFail($id);
        if ($user->perfil == null) {
            $perfil = new Perfil;
            $perfil->apellidos = $request->get('apellidos') ?? '';
            $perfil->apodo = $request->get('apodo') ?? '';
            $perfil->telefono = $request->get('telefono') ?? '';
            $perfil->about = $request->get('about') ?? '';
            $perfil->user_id = auth()->user()->id;
            $perfil->save();
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
        return $id;
    }
}
