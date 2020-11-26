@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
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
                            <dd class="col-sm-8">{{ ucfirst($solicitud->motivo) }}</dd>
                            <dt class="col-sm-4">Descripcion</dt>
                            <dd class="col-sm-8">{{ ucfirst($solicitud->descripcion) }}</dd>
                            <dd class="col-sm-8 offset-sm-4">Donec id elit non mi porta gravida at eget metus.</dd>
                            <dt class="col-sm-4">Estado</dt>
                            <dd class="col-sm-8">
                                @if($solicitud->estado)
                                    <span class="badge badge-success">Aceptado</span>
                                    @else
                                    <span class="badge badge-danger">No aceptado</span>
                                @endif
                            </dd>
                            <dt class="col-sm-4">Estado de la mascota</dt>
                            <dd class="col-sm-8">
                                @if($solicitud->publicacion_adopcion->mascota->adoptado)
                                    <span class="badge badge-success">Adoptado</span>
                                @else
                                    <span class="badge badge-danger">No Adoptado</span>
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
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
    </div>
@endsection
