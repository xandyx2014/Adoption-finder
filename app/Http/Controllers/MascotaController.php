<?php

namespace App\Http\Controllers;

use App\Models\Especie;
use App\Models\Etiqueta;
use App\Models\Imagen;
use App\Models\Mascota;
use App\Models\Raza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MascotaController extends Controller
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
        $query = Mascota::orderBy('created_at', 'desc');
        if (request()->input('bin'))
        {
            $query = $query->onlyTrashed();
        }
        $mascotas = $query->paginate(3)
            ->appends(request()->query());
        return view('adopcion.mascota.index', compact('mascotas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
        foreach ($imagenes as $img)
        {
            $url =  Storage::disk('public')->put('', $img);
            $imagen = new Imagen;
            $imagen->url = $url;
            $mascota->imagens()->save($imagen);
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
        $mascota = Mascota::withTrashed()
            ->where('id', $id)
            ->with(['user', 'imagens', 'etiquetas', 'raza', 'especie'])
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
        $mascota = Mascota::findOrFail($id);
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
        $imagen = Imagen::withTrashed()->where('id', $id)->first();
        Storage::disk('public')->delete($imagen->url);
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

        $mascota = Mascota::findOrFail($id);
        $request->validate([
            'nombre' => 'required|min:0|max:200',
            'color' => 'required|min:0|max:150',
            'descripcion' => 'required|min:0|max:200',
            'tamagno' => 'required|min:0|max:200',
            'salud' => 'required',
            'about' => 'required',
        ]);
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
            // verificar las dependencias y force delete
            $countTotal = $especie->denuncias()->get()->count();
            $countTotalImagen = $especie->imagens()->get()->count();
            if ($countTotal == 0 || $countTotalImagen == 0) {
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
        $especie->delete();
        if (request()->ajax())
        {
            return response()->json([
                "message" => 'Borrado correctamente'
            ]);
        }
        return redirect()->route('mascota.index');
    }
}
