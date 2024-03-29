<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:listar-usuario')->only(['index']);
        $this->middleware('permiso:consultar-usuario')->only(['show']);
        $this->middleware('permiso:registrar-usuario')->only(['create']);
    }
    public function resendEmailVerification(Request $request)
    {
        $userId = request()->user()->id;
        $user = User::findOrFail($userId);
        $user->sendEmailVerificationNotification();
        return back()->with('status', 'Enviado mensaje de confirmacion al correo');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = User::orderBy('id', 'desc')->with([
            'rol' => function ($query) {
                $query->withTrashed();
            }
        ]);
        if (request()->has('bin')) {
            $query = $query->onlyTrashed();
        }
        if (request()->has('email') && request()->input('email') != null) {
            $email = request()->input('email');
            $query = $query->where('email', 'LIKE', "%$email%");
        }
        if (request()->has('name') && request()->input('name') != null) {
            $email = request()->input('name');
            $query = $query->where('name', 'LIKE', "%$email%");
        }
        if (request()->has('rol') && request()->input('rol') != "") {
            $email = request()->input('rol');
            $query = $query->where('rol_id', $email);
        }
        $query = $query->where('email', '!=', auth()->user()->email);
        $usuarios = $query->paginate(4)->appends(request()->query());
        $roles = Rol::all();
        return view('administracion.user.index', compact('usuarios', 'roles'));
    }

    public function report(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar reporte', 'Usuario'));
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1") {
            $especies = User::with('rol')->with([
                'rol' => function ($query) {
                    $query->withTrashed();
                }
            ])->get();
        } else {
            $especies = User::onlyTrashed()->with([
                'rol' => function ($query) {
                    $query->withTrashed();
                }
            ])->get();
        }
        /**/
        return view('administracion.user.report', [
            'especies' => $especies,
            'estado' => $estado
        ]);
    }

    function generatePdf(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Generar reporte pdf', 'Usuario'));
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1") {
            $especies = User::with('rol')->with([
                'rol' => function ($query) {
                    $query->withTrashed();
                }
            ])->get();
        } else {
            $especies = User::onlyTrashed()->with([
                'rol' => function ($query) {
                    $query->withTrashed();
                }
            ])->get();
        }
        $pdf = PDF::loadView('administracion.user.pdf', compact('especies'));
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
        dispatch( new \App\Jobs\BitacoraJob('Mostrar formulario creacion', 'Usuario'));
        $roles = Rol::all();
        return view('administracion.user.create', compact('roles'));
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'rol' => ['required']
        ]);
        dispatch( new \App\Jobs\BitacoraJob('Crear', 'Usuario'));
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'rol_id' => $request->get('rol'),
            'password' => Hash::make($request->get('password')),
        ]);
        return redirect()->route('user.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Consultar', 'Usuario'));
        $user = User::withTrashed()->where('id', $id)
            ->with([
                'publicacionInformativas' => function ($query) {
                    $query->withTrashed();
                },
                'publicacionAdopcions' => function ($query) {
                    $query->withTrashed();
                },
                'solicitudAdopcions' => function ($query) {
                    $query->withTrashed();
                },
                'adoptar' => function ($query) {
                    $query->withTrashed();
                }
            ])->first();
        return view('administracion.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar reporte', 'Usuario'));
        $user = User::findOrFail($id);
        $roles = Rol::all();
        return view('administracion.user.edit', compact('user', 'roles'));
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
        if ($request->has('restore')) {
            dispatch( new \App\Jobs\BitacoraJob('Cambio estado', 'Usuario'));
            User::withTrashed()->find($id)->restore();
            return back();
        }
        if ($request->has('edit')) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'email_verified_at' => null
            ]);
            dispatch( new \App\Jobs\BitacoraJob('Actualizar', 'Usuario'));
            return redirect()->route('user.index');
        }
        $user = User::findOrFail($id);
        $rol = Rol::findOrFail($request->get('rol'));
        $user->update([
            'rol_id' => $rol->id
        ]);
        return redirect()->route('user.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $especie = User::withTrashed()->find($id);
        $bin = request()->input('bin');
        if ($bin) {
            try {
                $especie->forceDelete();
                dispatch( new \App\Jobs\BitacoraJob('Eliminar', 'Usuario'));
                if (request()->ajax()) {
                    return response()->json([
                        "message" => 'Borrado correctamente'
                    ]);
                }
                return back();
            } catch (\Illuminate\Database\QueryException  $e) {
                return response()->json([
                    "error" => "$especie->name tiene dependencias"
                ]);
            }
        }
        $especie->delete();
        dispatch( new \App\Jobs\BitacoraJob('Cambio estado', 'Usuario'));
        if (request()->ajax()) {
            return response()->json([
                "message" => 'Borrado correctamente'
            ]);
        }
        return redirect()->route('user.index');
    }
}
