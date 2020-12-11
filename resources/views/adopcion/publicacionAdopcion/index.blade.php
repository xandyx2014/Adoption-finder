@extends('layouts.app')
@section('title', 'Publicacion de adopcion')
@section('content')
    <div class="container elevation-4 rounded">
        <div class="card">
            <div class="card-header">
                Publicaciones de adopcion
                @unless(request()->input('bin'))
                    @can('permiso', 'registrar-publicacion-adopcion')
                        <a
                            href="{{ route('publicacionAdopcion.create') }}"
                            class="btn btn-sm btn-secondary elevation-2">
                            Crear <i class="fa fa-book" aria-hidden="true"></i>
                        </a>
                    @endcan
                    @can('permiso', 'is-admin')
                        <button
                            data-toggle="modal" data-target="#reportModal"
                            class="btn btn-sm btn-outline-secondary elevation-2">
                            Reporte <i class="fa fa-file" aria-hidden="true"></i>
                        </button>
                    @endcan
                    @can('permiso', 'estado-publicacion-adopcion')
                        <a href="{{ route('publicacionAdopcion.index', [ 'bin' => true]) }}"
                           class="btn btn-sm btn-outline-danger elevation-2">
                            Papelera <i class="fa fa-recycle" aria-hidden="true"></i>
                        </a>
                    @endcan
                    @include('adopcion.publicacionAdopcion.select')
                @endunless
                @can('permiso', 'estado-publicacion-adopcion')
                    @if(request()->input('bin'))
                        <a href="{{ route('publicacionAdopcion.index') }}"
                           class="btn btn-sm btn-outline-success elevation-2">
                            Lista <i class="fa fa-list" aria-hidden="true"></i>
                        </a>
                    @endif
                @endcan
            </div>
            @unless(request()->has('bin'))
                @can('permiso', 'buscar-publicacion-adopcion')
                    <form action="{{ route('publicacionAdopcion.index') }}" method="POST"
                          class="input-group input-group-sm m-2">
                        @csrf
                        @method('GET')
                        <input name="search" class="form-control form-control-navbar" type="search"
                               placeholder="Buscar por titulo">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                @endcan
            @endunless
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                    <tr class="bg-dark elevation-1">
                        <th scope="col">ID</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Creado</th>
                        <th scope="col">Actualizado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($publicaciones as $publicacion )
                        <tr>
                            <th scope="row">{{ $publicacion->id }}</th>
                            <td>{{ $publicacion->titulo }}</td>
                            <td> {{ \Illuminate\Support\Carbon::parse( $publicacion->created_at)->format('d-M-Y')}}</td>
                            <td>{{ $publicacion->updated_at }}</td>
                            <td>
                                @if(request()->has('bin'))
                                    @include('adopcion.publicacionAdopcion.actionsBin', [ 'data' => $publicacion])
                                @else
                                    @include('adopcion.publicacionAdopcion.action', [ 'data' => $publicacion])
                                @endif

                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                    {{ $publicaciones->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
