@extends('layouts.app')
@section('title', 'Roles')
@section('content')
    <form action="{{ route('rol.update', $rol->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="card card-primary elevation-4">
                        <div class="card-header">
                            <h3 class="card-title">Rol</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" name="rol" value="{{ old('rol', $rol->nombre) }}"
                                       class="form-control @error('rol') is-invalid @enderror"
                                       placeholder="Nombre del rol ...">
                                @error('rol')
                                <div class="error invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                        <!-- /.card-body -->

                    </div>
                </div>
                {{--<div class="col-7">
                    <div class="card card-primary elevation-4">
                        <div class="card-header">
                            <h3 class="card-title">Permisos</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                <div class="form-group p-0 m-0">
                                    <label>Gestionar usuario</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    --}}{{--{{ collect(old('etiquetas', $mascota->etiquetas->pluck('id')))->contains($etiqueta->id) ? 'checked': '' }}--}}{{--
                                    <input name="permisos[]" class="form-check-input" type="checkbox"
                                           id="inlineCheckbox1" checked>
                                    <label class="form-check-label" for="inlineCheckbox1">Ver usuario</label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>

                    </div>
                </div>--}}
            </div>
        </div>
    </form>
@endsection
