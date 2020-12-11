@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    <div class="container elevation-2">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Reporte de Mascota
                        <form action="{{ route('reporteMascota.pdf') }}" method="post">
                            @csrf
                             <input type="text" name="user" value="{{ old('user', $user) }}" hidden>
                             <input type="text" name="mascota" value="{{ old('mascota', $mascota->id) }}" hidden>
                             <input type="text" name="adoptador" value="{{ old('adoptador', $adoptador) }}" hidden>
                             <input type="text" name="publicacion" value="{{ old('publicacion', $publicacion) }}" hidden>
                             <input type="text" name="solicitud" value="{{ old('solicitud', $solicitud) }}" hidden>
                             <input type="text" name="denuncia" value="{{ old('denuncia', $denuncia) }}" hidden>
                            <button
                                type="submit"
                                class="btn btn-sm btn-outline-secondary elevation-2">
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
                                    <b>Modelo: </b> Mascota
                                </p>
                                <p>
                                    <b>Generado por:</b> {{ auth()->user()->name }}
                                </p>
                                <p>
                                    <b>Correo :</b> {{ auth()->user()->email }}
                                </p>
                            </div>
                        </div>
                        <label> Mascota </label>
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Color</th>
                                <th scope="col">Descripcion</th>
                                <th scope="col">Tamaño</th>
                                <th scope="col">Salud</th>
                                <th scope="col">Genero</th>
                                <th scope="col" style="width: 20%">Acerca de</th>
                                <th scope="col">Adoptado</th>
                                <th scope="col">Creado</th>
                                <th scope="col">Actualizado</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $mascota->id }}</td>
                                <td>{{ $mascota->nombre }}</td>
                                <td>{{ $mascota->color }}</td>
                                <td>{{ $mascota->descripcion }}</td>
                                <td>{{ $mascota->tamagno }}</td>
                                <td>{{ $mascota->salud }}</td>
                                <td>{{ $mascota->genero }}</td>
                                <td>{{ $mascota->about }}</td>
                                @if($mascota->adoptado == 1)
                                    <td>Si</td>
                                @else
                                    <td>No</td>
                                @endif
                                <td>{{ $mascota->created_at }}</td>
                                <td>{{ $mascota->updated_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <label> Raza</label>
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col" style="width: 20%">Descripcion</th>
                                <th scope="col">Creado</th>
                                <th scope="col">Actualizado</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $mascota->raza->id }}</td>
                                <td>{{ $mascota->raza->nombre }}</td>
                                <td>{{ $mascota->raza->descripcion }}</td>
                                <td>{{ $mascota->raza->created_at }}</td>
                                <td>{{ $mascota->raza->updated_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <label> Especie</label>
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col" style="width: 20%">Descripcion</th>
                                <th scope="col">Creado</th>
                                <th scope="col">Actualizado</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td>{{ $mascota->especie->id }}</td>
                                <td>{{ $mascota->especie->nombre }}</td>
                                <td>{{ $mascota->especie->descripcion }}</td>
                                <td>{{ $mascota->especie->created_at }}</td>
                                <td>{{ $mascota->especie->updated_at }}</td>
                            </tr>
                            </tbody>
                        </table>
                        <label> Etiquetas Total : {{ count($mascota->etiquetas ?? []) }}</label>
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Creado</th>
                                <th scope="col">Actualizado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($mascota->etiquetas as $etiqueta)
                                <tr>

                                    <td>{{ $etiqueta->id }}</td>
                                    <td>{{ $etiqueta->nombre }}</td>
                                    <td>{{ $etiqueta->created_at }}</td>
                                    <td>{{ $etiqueta->updated_at }}</td>

                                </tr>
                                @empty
                                <tr>
                                    <td>No tiene etiquetas</td>
                                </tr>
                            @endforelse
                            </tbody>
                        </table>
                        <br>
                        @if($user == 1)
                            <label> Usuario creador de la mascota</label>
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col" style="width: 20%">Email</th>
                                    <th scope="col">Creado</th>
                                    <th scope="col">Actualizado</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr>
                                    <td>{{ $mascota->user->id }}</td>
                                    <td>{{ $mascota->user->name }}</td>
                                    <td>{{ $mascota->user->email }}</td>
                                    <td>{{ $mascota->user->created_at }}</td>
                                    <td>{{ $mascota->user->updated_at }}</td>
                                </tr>
                                </tbody>
                            </table>
                        @endif
                        <br>
                        @if($adoptador == 1)
                            <label> Usuario adoptador de la mascota</label>
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col" style="width: 20%">Email</th>
                                    <th scope="col">Creado</th>
                                    <th scope="col">Actualizado</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($mascota->propetario != null)
                                    <tr>
                                        <td>{{ $mascota->user->id }}</td>
                                        <td>{{ $mascota->user->name }}</td>
                                        <td>{{ $mascota->user->email }}</td>
                                        <td>{{ $mascota->user->created_at }}</td>
                                        <td>{{ $mascota->user->updated_at }}</td>
                                    </tr>
                                @else
                                    <tr>
                                        <td>No hay adoptado</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        @endif
                        <br>
                        @if($publicacion == 1)
                            <label> Publicaciones creada de la para la mascota</label>
                            <table class="table table-sm">
                                <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Titulo</th>
                                    @if($denuncia == 1)
                                    <th scope="col">Total denuncias</th>
                                    @endif()
                                    @if($solicitud == 1)
                                    <th scope="col">Total Solicitudes</th>
                                    @endif
                                    <th scope="col">Creado</th>
                                    <th scope="col">Actualizado</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if(count($mascota->publicacionAdopcions()->withTrashed()->get()) > 0)
                                    @foreach($mascota->publicacionAdopcions()->withTrashed()->get() as $publicacion)
                                        <tr>
                                            <td>{{ $publicacion->id }}</td>
                                            <td>{{ $publicacion->titulo }}</td>
                                            @if($denuncia == 1)
                                                <td>{{ count($publicacion->denuncias) }}</td>
                                            @endif
                                            @if($solicitud == 1)
                                            <td>{{ count($publicacion->solicitudAdopcions) }}</td>
                                            @endif
                                            <td>{{ $publicacion->created_at }}</td>
                                            <td>{{ $publicacion->updated_at }}</td>

                                        </tr>
                                    @endforeach
                                    @else
                                    <tr>
                                        <td>Sin Publicaciones</td>
                                    </tr>
                                @endif
                                </tbody>
                            </table>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
