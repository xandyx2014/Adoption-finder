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
                <div class="col-5">
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
                                    @if($loop->iteration % 4  == 1)
                                        <br class="m-0 p-0">
                                    @endif
                                    <div class="form-check form-check-inline">
                                        {{-- --}}
                                        <input
                                            name="permisos[]"
                                            class="form-check-input"
                                            {{ collect(old('permisos', $rol->permiso->pluck('id')))->contains($permiso->id) ? 'checked': '' }}
                                            type="checkbox"
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

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">Asignar</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
