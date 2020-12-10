<?php

namespace App\Http\Controllers;

use App\Models\Denuncia;
use App\Models\Mascota;
use App\Models\PublicacionAdopcion;
use App\Models\PublicacionInformativa;
use App\Models\SolicitudAdopcion;
use App\Models\TipoDenuncia;
use Illuminate\Http\Request;

class AdoptionFinderController extends Controller
{
    function __construct()
    {
        $this->middleware('auth')->except(['index']);
    }

    function index()
    {
        // Solo publicaciones de mascotas adoptadas
        $tipoDenuncia = TipoDenuncia::all();
        $publicaciones = PublicacionAdopcion::orderBy('id', 'desc')
            ->whereHas('mascota', function ($query) {
                return $query->where('adoptado', 0);
            })
            ->with([
                'user' => function ($query) {
                    $query->withTrashed();
                },
                'mascota' => function ($query) {
                    $query->where('adoptado', 0);
                },
                'mascota.etiquetas',
            ])->paginate(3);
        return view('adoptionFInder.index',
            compact('publicaciones', 'tipoDenuncia')
        );
    }

    function show($id)
    {
        try {
            $publicacion = PublicacionAdopcion::where('id', $id);
            $publicacion = $publicacion->with([
                'mascota.user',
            ])->first();
            if ($publicacion->mascota == null) {
                abort(404);
            }
            if ($publicacion->mascota->adoptado == 1)
            {
                abort(404);
            }
            return view('adoptionFInder.show',
                compact('publicacion')
            );
        } catch (\Exception $e)
        {
            abort(404);
        }

    }
    function store(Request $request)
    {
        $validate = $request->validate([
            'id' => 'required',
            'motivo' => ['required', 'min:10', 'max:200'],
            'descripcion' => ['required', 'min:20','max:200'],
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Crear', 'Solicitud adopcion'));
        $id = $request->get('id');
        $cantidadSolicitudes = PublicacionAdopcion::where('id', $id)
            ->with([
            'solicitudAdopcions' => function ($query) {
                    return $query->where('user_id', auth()->user()->id);
                }
        ])->first();
        $mascota = Mascota::findOrFail($cantidadSolicitudes->mascota_id);
        if ($mascota != null)
        {
            if ($mascota->adoptado == 1)
            {
                abort(404);
            }
        }
        $cantidad = collect( collect( $cantidadSolicitudes)['solicitud_adopcions'] ?? [])->count();
        if ($cantidad >= 3)
        {
            return redirect()->route('finder.index')->with('info', 'Gracias por enviar tu solicitud');
        }
        $solicitud = new SolicitudAdopcion;
        $solicitud->motivo = $request->get('motivo');
        $solicitud->descripcion = $request->get('descripcion');
        $solicitud->publicacion_adopcion_id = $request->get('id');
        $solicitud->user_id = auth()->user()->id;
        $solicitud->save();
        return redirect()->route('finder.index')->with('success', 'Gracias por enviar tu solicitud');
    }
    public function destroy($id)
    {
        // id de la publicacion
        $validate = request()->validate([
            'descripcion' => ['required', 'min:20','max:200'],
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Crear', 'Denuncia'));
        $denuncia = new Denuncia;
        $denuncia->descripcion = request()->get('descripcion');
        $denuncia->tipo_denuncia_id = request()->get('tipo');
        PublicacionAdopcion::findOrFail($id)->denuncias()->save($denuncia);
        return back()->with('denuncia', 'Gracias por enviar tu solicitud');
    }
}
