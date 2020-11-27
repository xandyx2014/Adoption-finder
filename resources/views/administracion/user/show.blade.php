@extends('layouts.app')
@section('title', 'Especie')
@section('content')
    <div class="container elevation-4 p-4 rounder">
        <div class="row">
            <div class="col-6">
                <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <h6 class="border-bottom border-gray pb-2 mb-0">Usuario</h6>
                    <div class="media text-muted pt-3">
                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <strong class="d-block text-gray-dark">Nombre</strong>
                           {{ $user->name }}
                        </p>
                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <strong class="d-block text-gray-dark">Email</strong>
                            {{ $user->email }}
                        </p>
                        <p class="media-body pb-3 mb-0 small lh-125 border-bottom border-gray">
                            <strong class="d-block text-gray-dark">Email Verificado</strong>
                            @if($user->email_verified_at == null)
                                <span class=" p-2 badge badge-danger">No Verificado</span>
                                @else
                                <span class=" p-2 badge badge-success"> Verificado</span>
                            @endif

                        </p>
                    </div>
                    <h6 class="p-1 border-bottom border-gray pb-2 mb-0">
                        Publicaciones informativas:
                        <span class="p-2 badge badge-primary">{{ count($user->publicacion_informativas ?? []) }}</span>
                    </h6>
                    <h6 class="p-1 border-bottom border-gray pb-2 mb-0">
                        Publicaciones de Adopcion:
                        <span class="p-2 badge badge-primary">{{ count($user->publicacion_adopcions ?? []) }}</span>
                    </h6>
                    <h6 class="p-1 border-bottom border-gray pb-2 mb-0">
                        Solicitudes de adopcion:
                        <span class="p-2 badge badge-primary">{{ count($user->solicitud_adopcions ?? []) }}</span>
                    </h6>
                    <h6 class="p-1 border-bottom border-gray pb-2 mb-0">
                        Mascotas adoptadas:
                        <span class="p-2 badge badge-primary">{{ count($user->adoptar ?? []) }}</span>
                    </h6>
                </div>
            </div>
            <div class="col-6">
                <div class="my-3 p-3 bg-white rounded shadow-sm">
                    <h6 class="border-bottom border-gray pb-2 mb-0">Mascotas adoptadas</h6>
                    <div class="media text-muted pt-3">
                        @if($user->adoptar != null)
                            @foreach($user->adoptar as $mascota)
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item p-0"><b>ID:</b> {{ $mascota->id }}</li>
                                    <li class="list-group-item p-0"><b>Nombre:</b>  {{ $mascota->nombre }}</li>
                                    <li class="list-group-item p-0"> <b>Descripcion:</b> {{ $mascota->descripcion }}</li>
                                    <li class="list-group-item p-0"> <b> Tamaño:</b> {{ $mascota->tamagno }}</li>
                                    <li class="list-group-item p-0"> <b> Vista:</b> <a target="_blank" href="{{ route('mascota.show', $mascota->id) }}" class="badge badge-primary">Mascota</a> </li>
                                </ul>
                            @endforeach
                            @else
                            Ninguna mascota adoptada
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
