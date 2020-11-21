@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Listado de etiquetas
                        <form action="{{ route('publicacion.pdf') }}" method="post">
                            @csrf
                            <input type="text" name="estado" value="{{ old('estado', $estado) }}" hidden>
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
                                    <b>Modelo: </b>Publicacion
                                </p>
                                <p>
                                    <b>Generado por:</b> {{ auth()->user()->name }}
                                </p>
                                <p>
                                    <b>Correo :</b> {{ auth()->user()->email }}
                                </p>
                                <p><b>Total filas:</b> {{ $especies->count() }}</p>
                            </div>
                        </div>
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col" style="width: 35%">Titulo</th>
                                <th scope="col">Creado</th>
                                <th scope="col">Actualizado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($especies as $especie)
                                <tr>
                                    <td>{{ $especie->id }}</td>
                                    <td>{{ $especie->titulo }}</td>
                                    <td>{{ $especie->created_at }}</td>
                                    <td>{{ $especie->updated_at }}</td>
                                </tr>
                            @empty
                                <tr style="text-align: center">
                                    <p>No hay datos</p>
                                </tr>
                            @endforelse

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
