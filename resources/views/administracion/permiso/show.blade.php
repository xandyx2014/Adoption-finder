@extends('layouts.app')
@section('title', 'Roles')
@section('content')
    <form action="{{ route('permiso.update', $rol->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="row db-flex justify-content-center">
                <div class="col-4">
                    <div class="card card-primary elevation-4">
                        <div class="card-header">
                            <h3 class="card-title">Rol</h3>
                        </div>
                        <div class="card-body">
                            <label>Nombre: </label>
                            <span class="badge badge-secondary p-2">
                                {{ $rol->nombre }}
                            </span>

                        </div>
                        <!-- /.card-body -->

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card card-primary elevation-4">
                        <div class="card-header">
                            <h3 class="card-title">Permisos</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="form-group p-0 m-0">
                                    <label>Permisos disponibles</label>
                                </div>
                                @foreach($permisos as $permiso)
                                    @if($loop->index == 0)
                                        <p class="text-bold pb-0 mb-0">
                                            Gestionar mascota
                                        </p>
                                        <br>
                                    @endif
                                    @if($loop->index == 7)
                                        <p class="text-bold pb-0 mb-0">
                                            Gestionar publicacion de adopcion
                                        </p>
                                        <br>
                                    @endif
                                    @if($loop->index == 14)
                                        <p class="text-bold pb-0 mb-0">
                                            Gestionar seguimiento de mascota adoptada
                                        </p>
                                        <br>
                                    @endif
                                        @if($loop->index == 21)
                                            <p class="text-bold pb-0 mb-0">
                                                Aprobar rechazar solicitud de adopcion
                                            </p>
                                            <br>
                                        @endif
                                        @if($loop->index == 24)
                                            <p class="text-bold pb-0 mb-0">
                                                Administrar galeria de foto de mascota
                                            </p>
                                            <br>
                                        @endif
                                        @if($loop->index == 27)
                                            <p class="text-bold pb-0 mb-0">
                                                Gestionar solicitud de adopcion
                                            </p>
                                            <br>
                                        @endif
                                        @if($loop->index == 34)
                                            <p class="text-bold pb-0 mb-0">
                                                Gestionar tipo de publicacion
                                            </p>
                                            <br>
                                        @endif
                                        @if($loop->index == 41)
                                            <p class="text-bold pb-0 mb-0">
                                                Gestionar tipo de denuncia
                                            </p>
                                            <br>
                                        @endif
                                        @if($loop->index == 48)
                                            <p class="text-bold pb-0 mb-0">
                                                Aprobar o rechazar solicitud de publicacion informativa
                                            </p>
                                            <br>
                                        @endif
                                        @if($loop->index == 51)
                                            <p class="text-bold pb-0 mb-0">
                                                Administrar galeria de foto de publicacion
                                            </p>
                                            <br>
                                        @endif
                                        @if($loop->index == 54)
                                            <p class="text-bold pb-0 mb-0">
                                                Gestionar publicaciones informativas
                                            </p>
                                            <br>
                                        @endif
                                        @if($loop->index == 61)
                                            <p class="text-bold pb-0 mb-0">
                                                Gestionar denuncia
                                            </p>
                                            <br>
                                        @endif
                                        @if($loop->index == 68)
                                            <p class="text-bold pb-0 mb-0">
                                                Gestionar especie
                                            </p>
                                            <br>
                                        @endif
                                        @if($loop->index == 75)
                                            <p class="text-bold pb-0 mb-0">
                                                Gestionar raza
                                            </p>
                                            <br>
                                        @endif
                                        @if($loop->index == 82)
                                            <p class="text-bold pb-0 mb-0">
                                                Gestionar etiqueta
                                            </p>
                                            <br>
                                        @endif
                                        @if($loop->index == 89)
                                            <p class="text-bold pb-0 mb-0">
                                                Gestionar usuario
                                            </p>
                                            <br>
                                        @endif
                                        @if($loop->index == 96)
                                            <p class="text-bold pb-0 mb-0">
                                                Gestionar rol
                                            </p>
                                            <br>
                                        @endif
                                        @if($loop->index == 103)
                                            <p class="text-bold pb-0 mb-0">
                                                Administrar permiso
                                            </p>
                                            <br>
                                        @endif
                                        @if($loop->index == 106)
                                            <p class="text-bold pb-0 mb-0">
                                                Administrar bitacora
                                            </p>
                                            <br>
                                        @endif
                                        @if($loop->index == 109)
                                            <p class="text-bold pb-0 mb-0">
                                                Generar reporte mascota
                                            </p>
                                            <br>
                                        @endif
                                        @if($loop->index == 110)
                                            <p class="text-bold pb-0 mb-0">
                                                Generar reporte seguimiento
                                            </p>
                                            <br>
                                        @endif


                                    <div class="form-check form-check-inline">
                                        <input
                                            name="permisos[]"
                                            class="form-check-input"
                                            {{ collect(old('permisos', $rol->permiso->pluck('id')))->contains($permiso->id) ? 'checked': '' }}
                                            type="checkbox"
                                            value="{{ $permiso->id }}"
                                            id="inlineCheckbox-{{ $permiso->id }}">
                                        <label class="form-check-label" for="inlineCheckbox-{{ $permiso->id }}">
                                            {{ ucfirst($permiso->nombre) }}
                                        </label>
                                    </div>
                                @endforeach


                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Asignar</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
