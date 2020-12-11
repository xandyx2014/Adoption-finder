@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    <div class="container elevation-2">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Listado de mascotas
                        <form action="{{ route('mascota.pdf') }}" method="post">
                            @csrf
                            <input type="text" name="estado" value="{{ old('estado', $estado) }}" hidden>
                            <input type="text" name="adoptado" value="{{ old('adoptado', $adoptado) }}" hidden>
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
                                    <b>Modelo: </b>Mascotas
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
                                <th scope="col" style="width: 10%">ID</th>
                                <th scope="col" >Nombre</th>
                                <th scope="col" >Color</th>
                                <th scope="col" >Tamaño</th>
                                <th scope="col" >Salud</th>
                                <th scope="col" >Genero</th>
                                <th scope="col" style="width: 20%">Descripcion</th>
                                <th scope="col" style="width: 20%">Acerca de</th>
                                <th scope="col">Creado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($especies as $especie)
                                <tr>
                                    <td>{{ $especie->id }}</td>
                                    <td>{{ $especie->nombre }}</td>
                                    <td>{{ $especie->color }}</td>
                                    <td>{{ $especie->tamagno }}</td>
                                    <td>{{ $especie->salud }}</td>
                                    <td>{{ $especie->genero }}</td>
                                    <td>{{ $especie->descripcion }}</td>
                                    <td>{{ $especie->about }}</td>
                                    <td>{{ $especie->created_at }}</td>
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
