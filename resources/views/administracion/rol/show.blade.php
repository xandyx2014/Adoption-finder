@extends('layouts.app')
@section('title', 'Roles')
@section('content')
        <div class="container">
            <div class="row">
                <div class="col-5">
                    <div class="card card-primary elevation-4">
                        <div class="card-header">
                            <h3 class="card-title">Rol</h3>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label>Nombre</label>
                                <input type="text" disabled name="rol" value="{{ old('rol', $rol->nombre) }}"
                                       class="form-control @error('rol') is-invalid @enderror"
                                       placeholder="Nombre del rol ...">
                                @error('rol')
                                <div class="error invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </div>

                        </div>
                        <!-- /.card-body -->

                    </div>
                </div>
                <div class="col-7">
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
                                    {{--{{ collect(old('etiquetas', $mascota->etiquetas->pluck('id')))->contains($etiqueta->id) ? 'checked': '' }}--}}
                                    <input name="permisos[]" class="form-check-input" type="checkbox"
                                           id="inlineCheckbox1" checked  disabled>
                                    <label class="form-check-label" for="inlineCheckbox1">Ver usuario</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input name="permisos[]" class="form-check-input" type="checkbox"
                                           id="inlineCheckbox2" value="option2" disabled>
                                    <label class="form-check-label" for="inlineCheckbox2">Actualizar usuario</label>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->



                    </div>
                </div>
            </div>
        </div>

@endsection
