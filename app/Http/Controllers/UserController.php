<?php

namespace App\Http\Controllers;

use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        $query = User::orderBy('id', 'desc');
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
        $query = $query->where('email', '!=', auth()->user()->email);
        $usuarios = $query->paginate(4)->appends(request()->query());
        return view('administracion.user.index', compact('usuarios'));
    }

    public function report(Request $request)
    {
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1") {
            $especies = User::all();
        } else {
            $especies = User::onlyTrashed()->get();
        }
        /**/
        return view('administracion.user.report', [
            'especies' => $especies,
            'estado' => $estado
        ]);
    }

    function generatePdf(Request $request)
    {
        $estado = $request->get('estado');
        $especies;
        if ($estado == "1") {
            $especies = User::all();
        } else {
            $especies = User::onlyTrashed()->get();
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
        return view('administracion.user.create');
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
        ]);
        User::create([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
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
        $user = User::findOrFail($id);
        return view('administracion.user.edit', compact('user'));
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
            return redirect()->route('user.index');
        }
        return "Actualizar roles";


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
        if (request()->ajax()) {
            return response()->json([
                "message" => 'Borrado correctamente'
            ]);
        }
        return redirect()->route('user.index');
    }
}
