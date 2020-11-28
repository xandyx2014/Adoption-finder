<?php

namespace App\Http\Controllers;

use App\Models\Rol;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            'rol' => ['required', 'min:5', 'max:200']
        ]);
        Rol::create([
            'nombre' => $request->get('rol')
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
        $rol = Rol::where('id', $id)->withTrashed()->first();
        return view('administracion.rol.show', compact('rol'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $rol = Rol::findOrFail($id);
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
        $request->validate([
            'rol' => ['required', 'min:5', 'max:200']
        ]);
        $rol = Rol::findOrFail($id);
        $rol->update([
            'nombre' => $request->get('rol')
        ]);
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
        //
    }
}
