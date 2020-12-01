@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    <div class="container elevation-2">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Listado
                        <form action="{{ route('bitacora.pdf') }}" method="post">
                            @csrf
                            <input hidden type="text" name="user" value="{{ old('user', $user) }}">
                            <input hidden type="text" name="hasta" value="{{ old('hasta', $hasta) }}">
                            <input hidden type="text" name="desde" value="{{ old('desde', $desde) }}">
                            <button
                                type="submit"
                                class="btn btn-sm btn-outline-secondary">
                                Generar PDF <i class="fa fa-file" aria-hidden="true"></i>
                            </button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div>
                            <div>
                                <p>
                                    <b>Generado en:</b>{{  \Carbon\Carbon::now()->format('d-M-Y') }}
                                </p>
                                <p>
                                    <b>Modelo: </b> Bitacora
                                </p>
                                <p>
                                    <b>Generado por:</b> {{ auth()->user()->name }}
                                </p>
                                <p>
                                    <b>Correo :</b> {{ auth()->user()->email }}
                                </p>
                                <p><b>Total filas:</b> {{ $bitacoras->count() }}</p>
                            </div>
                        </div>
                        <table class="table ">
                            <thead class="thead-dark">
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Accion</th>
                                <th scope="col">Modelo</th>
                                <th scope="col">Fecha</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($bitacoras as $bitacora)
                                <tr>
                                    <th scope="row">{{ $bitacora->id }}</th>
                                    <td>{{ $bitacora->accion }}</td>
                                    <td>{{ $bitacora->entidad }}</td>
                                    <td>{{ $bitacora->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
