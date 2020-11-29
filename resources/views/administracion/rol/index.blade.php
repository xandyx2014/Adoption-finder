@extends('layouts.app')
@section('title', 'Roles')
@section('content')
    <div class="container ">
        <div class="row">
            <div class="col">
                <div class="card elevation-4 rounded">
                    <div class="card-header">
                        Roles
                        @unless(request()->has('bin'))
                            <button type="button" class="btn btn-sm btn-secondary elevation-2" data-toggle="modal"
                                    data-target="#searchModal">
                                Busqueda
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                            <a
                                href="{{ route('rol.index') }}"
                                class="btn btn-sm btn-outline-secondary elevation-2">
                                Limpiar busqueda
                                <i class="fa fa-ban" aria-hidden="true"></i>
                            </a>
                            @include('administracion.rol.search')
                            <a
                                href="{{ route('rol.create') }}"
                                class="btn btn-sm btn-secondary elevation-2">
                                Crear <i class="fa fa-book" aria-hidden="true"></i>
                            </a>
                            <button
                                data-toggle="modal" data-target="#reportModal"
                                class="btn btn-sm btn-outline-secondary elevation-2">
                                Reporte <i class="fa fa-file" aria-hidden="true"></i>
                            </button>
                            <a href="{{ route('rol.index', [ 'bin' => true]) }}"
                               class="btn btn-sm btn-outline-danger elevation-2">
                                Papelera <i class="fa fa-recycle" aria-hidden="true"></i>
                            </a>
                            @include('administracion.rol.select')
                        @endunless
                        @if(request()->has('bin'))
                            <a href="{{ route('rol.index') }}" class="btn btn-sm btn-outline-success elevation-2">
                                Lista <i class="fa fa-list" aria-hidden="true"></i>
                            </a>
                        @endif

                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                            <tr class="bg bg-primary">
                                <th scope="col">ID</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Creado</th>
                                <th scope="col">Actualizado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach( $roles as $rol)
                                @unless($rol->nombre == 'admin')
                                <tr>
                                    <th scope="row">{{ $rol->id }}</th>
                                    <td>{{ $rol->nombre  }}</td>
                                    <td>{{ $rol->created_at }}</td>
                                    <td>{{ $rol->updated_at }}</td>
                                    <td>
                                        @unless(request()->has('bin'))
                                            @include('administracion.rol.action', [ 'data' => $rol])
                                        @else
                                            @include('administracion.rol.actionsBin', [ 'data' => $rol])
                                        @endunless
                                    </td>
                                </tr>
                                @endunless
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="pull-right">
                            {{ $roles->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
