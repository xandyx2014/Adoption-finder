@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    @push('css')
        <style type="text/css">
            textarea {
                max-height: 150px;
            }
        </style>
    @endpush
    <form action="{{ route('solicitud.update', $solicitud->id) }}" method="POST">
        @csrf
        @method('PUT')
    <div class="container elevation-4 rounded p-4">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="fa fa-text-width"></i>
                            Solicitud de adopcion de mascota

                        </h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <dl class="row">
                            <dt class="col-sm-4">Motivo</dt>
                            <dd class="col-sm-8">
                                {{--{{ ucfirst($solicitud->motivo) }}--}}
                                <textarea name="motivo" max="100" id="motivo" class="form-control @error('motivo') is-invalid @enderror" rows="3" placeholder="Motivo ..." style="margin-top: 0px; margin-bottom: 0px; height: 108px;"></textarea>
                                @error('motivo')
                                <div class="error invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </dd>
                            <dt class="col-sm-4">Descripcion</dt>
                            <dd class="col-sm-8">
                               {{-- <input  value="{{ old('descripcion', ucfirst($solicitud->descripcion)) }}" class="form-control form-control-sm" type="text">--}}
                                <textarea name="descripcion" id="descripcion" class="form-control  @error('descripcion') is-invalid @enderror" rows="3" placeholder="Descripcion ..." style="margin-top: 0px; margin-bottom: 0px; height: 108px;"></textarea>
                                @error('descripcion')
                                <div class="error invalid-feedback">
                                    {{ $message }}
                                </div>
                                @enderror
                            </dd>
                            <dd class="col-sm-8 offset-sm-4">Donec id elit non mi porta gravida at eget metus.</dd>
                            <dt class="col-sm-4">Estado</dt>
                            <dd class="col-sm-8">
                                @if($solicitud->estado)
                                    <span class="badge badge-success">Aceptado</span>
                                @else
                                    <span class="badge badge-danger">No aceptado</span>
                                @endif
                            </dd>
                            <dt class="col-sm-4">Publicacion</dt>
                            <dd class="col-sm-8">
                                <a href="/" class="badge badge-primary">Publicacion</a>
                            </dd>
                            <dt class="col-sm-4">Mascota</dt>
                            <dd class="col-sm-8">
                                <a href="/" class="badge badge-secondary">{{ $solicitud->publicacion_adopcion->mascota->nombre }}</a>
                            </dd>
                            <dt class="col-sm-4">Especie de la mascota</dt>
                            <dd class="col-sm-8">
                                <a href="/" class="badge badge-warning">{{ $solicitud->publicacion_adopcion->mascota->especie->nombre }}</a>
                            </dd>
                            <dt class="col-sm-4">Raza de la mascota</dt>
                            <dd class="col-sm-8">
                                <a href="/" class="badge badge-info">{{ $solicitud->publicacion_adopcion->mascota->raza->nombre }}</a>
                            </dd>
                        </dl>
                    </div>
                    <div class="card-footer">
                        <div class="pull-right">
                            <button class="btn btn-primary" type="submit">
                                Actualizar
                            </button>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
    </form>
    @push('js')
        <script type="application/javascript">
            document.getElementById("motivo").defaultValue = "{{ old('motivo', $solicitud->motivo) }}";
            document.getElementById("descripcion").defaultValue = "{{ old('descripcion', $solicitud->descripcion) }}";
        </script>
    @endpush
@endsection
