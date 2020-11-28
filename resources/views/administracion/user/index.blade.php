@extends('layouts.app')
@section('title', 'Usuarios')
@section('content')
    <div class="container p-4 rounded">
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Gestionar usuario
                        @unless(request()->has('bin'))
                            <button type="button" class="btn btn-sm btn-secondary elevation-2" data-toggle="modal"
                                    data-target="#searchModal">
                                Busqueda
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                            <a
                                href="{{ route('user.index') }}"
                                class="btn btn-sm btn-outline-secondary elevation-2">
                                Limpiar busqueda
                                <i class="fa fa-ban" aria-hidden="true"></i>
                            </a>
                            @include('administracion.user.search')
                            <a
                                href="{{ route('user.create') }}"
                                class="btn btn-sm btn-secondary elevation-2">
                                Crear <i class="fa fa-book" aria-hidden="true"></i>
                            </a>
                            <button
                                data-toggle="modal" data-target="#reportModal"
                                class="btn btn-sm btn-outline-secondary elevation-2">
                                Reporte <i class="fa fa-file" aria-hidden="true"></i>
                            </button>
                            <a href="{{ route('user.index', [ 'bin' => true]) }}"
                               class="btn btn-sm btn-outline-danger elevation-2">
                                Papelera <i class="fa fa-recycle" aria-hidden="true"></i>
                            </a>
                            @include('administracion.user.select')
                        @endunless
                        @if(request()->has('bin'))
                            <a href="{{ route('user.index') }}" class="btn btn-sm btn-outline-success elevation-2">
                                Lista <i class="fa fa-list" aria-hidden="true"></i>
                            </a>
                        @endif

                    </div>
                    <div class="card-body">
                        <table class="table table-sm">
                            <thead>
                            <tr class="bg-primary">
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Email</th>
                                <th scope="col">Rol</th>
                                <th scope="col">Acciones</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($usuarios as $user)
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td><span class="badge badge-info">Nombre del rol</span></td>
                                <td>
                                    @unless(request()->has('bin'))
                                        @include('administracion.user.action', [ 'data' => $user])
                                        @else
                                        @include('administracion.user.actionsBin', [ 'data' => $user])
                                    @endunless

                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer">
                        <div class="pull-right">
                            {{ $usuarios->appends(request()->query())->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
