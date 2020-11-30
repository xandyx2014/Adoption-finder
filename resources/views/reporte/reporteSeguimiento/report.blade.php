@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    <div class="container elevation-2">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">Reporte de Mascota
                        <form action="{{ route('reporteSeguimiento.pdf') }}" method="post">
                            @csrf
                            <input type="text" name="user" value="{{ old('user', $user) }}" hidden>
                            <input type="text" name="mascota" value="{{ old('mascota', $mascota->id) }}" hidden>
                            <input type="text" name="adoptador" value="{{ old('adoptador', $adoptador) }}" hidden>
                            <input type="text" name="etiqueta" value="{{ old('adoptador', $adoptador) }}" hidden>
                            <input type="text" name="raza" value="{{ old('adoptador', $adoptador) }}" hidden>
                            <input type="text" name="especie" value="{{ old('adoptador', $adoptador) }}" hidden>
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
                                    <b>Generado en: </b>{{  \Carbon\Carbon::now()->format('d-M-Y') }}
                                </p>
                                <p>
                                    <b>Modelo: </b> Seguimiento Mascota
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
                        <label> Seguimiento</label>
                        <table class="table table-sm">
                            <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col" style="width: 20%">Descripcion</th>
                                <th scope="col">Calidad</th>
                                <th scope="col">Puntuacion</th>
                                <th scope="col">Creado</th>
                                <th scope="col">Actualizado</th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse($mascota->seguimientos as $seguimiento)
                            <tr>
                                <td>{{ $seguimiento->id }}</td>
                                <td>{{ $seguimiento->descripcion }}</td>
                                <td>{{ $seguimiento->calidad }}</td>
                                <td>{{ $seguimiento->puntuacion }} / 100</td>
                                <td>{{ $seguimiento->created_at }}</td>
                                <td>{{ $seguimiento->deleted_at }}</td>

                                    @empty
                                    <td>
                                        No hay datos
                                    </td>
                            </tr>
                            @endforelse
                            </tbody>
                        </table>

                        @if(count( optional($mascota)->seguimientos ?? []) > 0)
                            <br>
                        <label> Puntuacion mas alta : {{ $mascota->seguimientos->max('puntuacion') }} </label>
                            <br>
                        <label> Puntuacion mas bajas : {{ $mascota->seguimientos->min('puntuacion') }} </label>
                            <br>
                        <label> Total registros : {{ $mascota->seguimientos->count() }} </label>
                            <br>
                        <label> Total gral puntuacion: {{ $mascota->seguimientos->sum('puntuacion') }} </label>
                            <br>
                        <label> Requerimiento : {{ $mascota->seguimientos->count() * 100 }} </label>
                            <br>
                        <label> % Adecuacion: {{ ( $mascota->seguimientos->sum('puntuacion') / ($mascota->seguimientos->count() * 100) ) * 100 }} %</label>
                            <br>
                        @endif
                        <br>
                        <br>
                        <br>
                        @if($etiqueta == 1)
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
                        @endif
                        @if($especie == 1)
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
                        @endif
                        @if($etiqueta == 1)
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
                        @endif
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
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
