@extends('layouts.app')
@section('title', 'Roles')
@section('content')
        <div class="container">
            <div class="row db-flex justify-content-center">
                <div class="col-4">
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
                <div class="col-5">
                    <div class="card card-primary elevation-4">
                        <div class="card-header">
                            <h3 class="card-title">Permisos actuales</h3>
                        </div>
                        <div class="card-body">
                            <div>
                                @foreach($permisos as $permiso)
                                    @if($loop->iteration % 4  == 1)
                                        <br class="m-0 p-0 bottom">
                                    @endif
                                    <div class="form-check form-check-inline">
                                        {{-- --}}
                                        <input
                                            name="permisos[]"
                                            class="form-check-input"
                                            {{ collect(old('permisos', $rol->permiso->pluck('id')))->contains($permiso->id) ? 'checked': '' }}
                                            type="checkbox"
                                            disabled
                                            value="{{ $permiso->id }}"
                                            id="inlineCheckbox-{{ $permiso->id }}">
                                        <label class="form-check-label" for="inlineCheckbox-{{ $permiso->id }}">
                                            {{ $permiso->nombre }}
                                        </label>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.card-body -->



                    </div>
                </div>
            </div>
        </div>

@endsection
