<?php

namespace App\Http\Controllers;

use App\Models\Bitacora;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

class BitacoraController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('permiso:listar-bitacora')->only(['index']);
        $this->middleware('permiso:consultar-bitacora')->only(['show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = User::withTrashed();
        if (request()->has('q') && request()->input('q') != "")
        {
            $q = request()->input('q');
            $query->where('name', 'LIKE', "%$q%");
            $query->orWhere('email', 'LIKE', "%$q%");
        }
        $users = $query->paginate(4)->appends(request()->query());
        return view('administracion.bitacora.index', compact('users'));
    }
    public function report(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Mostrar reporte', 'Bitacora'));

        $id = $request->get('user');
        $desde = request()->input('desde');
        $hasta = Carbon::parse(request()->input('hasta'))->addDays(1);
        $especies = $especies = Bitacora::orderBy('id', 'desc')
            ->where('user_id', $id)
            ->whereBetween('created_at', [$desde, $hasta])
            ->get();
        return view('administracion.bitacora.report', [
            'bitacoras' => $especies,
            'user' => $id,
            'hasta' => $hasta,
            'desde' => $desde,
        ]);
    }
    function generatePdf(Request $request)
    {
        dispatch( new \App\Jobs\BitacoraJob('Generar reporte pdf', 'Bitacora'));
        $id = $request->get('user');
        $desde = request()->input('desde');
        $hasta = Carbon::parse(request()->input('hasta'))->addDays(1);
        $bitacoras = Bitacora::orderBy('id', 'desc')
            ->where('user_id', $id)
            ->whereBetween('created_at', [$desde, $hasta])
            ->get();
        $pdf = PDF::loadView('administracion.bitacora.pdf', compact('bitacoras'));
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
     * @param  \App\Models\Bitacora  $bitacora
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::withTrashed()
            ->where('id', $id)->first();
        $query = Bitacora::orderBy('id', 'desc')->where('user_id', $id);
        if (request()->has('desde') && request()->has('desde') != "" && request()->has('hasta') != "")
        {
            $desde = request()->input('desde');
            $hasta = Carbon::parse(request()->input('hasta'))->addDays(1);
            $query->whereBetween('created_at', [$desde, $hasta]);
        }
        $bitacoras = $query->paginate(10)->appends(request()->query());
        return view('administracion.bitacora.show', compact('user', 'bitacoras'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Bitacora  $bitacora
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Bitacora  $bitacora
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Bitacora  $bitacora
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
