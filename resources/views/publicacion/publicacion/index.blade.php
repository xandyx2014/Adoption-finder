@extends('layouts.app')
@section('title', 'Especie')
@section('content')
    @once
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
              integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
              crossorigin="anonymous"/>
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/select2-bootstrap-theme/0.1.0-beta.10/select2-bootstrap.css"
            integrity="sha512-CbQfNVBSMAYmnzP3IC+mZZmYMP2HUnVkV4+PwuhpiMUmITtSpS7Prr3fNncV1RBOnWxzz4pYQ5EAGG4ck46Oig=="
            crossorigin="anonymous"/>
    @endpush
    @endonce
    <div class="container elevation-4">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Tipo de publicacion
                        @unless($bin)
                            @can('permiso', 'buscar-publicacion-informativa')
                                <button type="button" class="btn btn-sm btn-secondary elevation-2" data-toggle="modal"
                                        data-target="#searchModal">
                                    Busqueda
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </button>
                                <a
                                    href="{{ route('publicacion.index') }}"
                                    class="btn btn-sm btn-outline-secondary elevation-2">
                                    Limpiar busqueda
                                    <i class="fa fa-ban" aria-hidden="true"></i>
                                </a>
                            @endcan
                            @can('permiso', 'registrar-publicacion-informativa')
                                <a
                                    href="{{ route('publicacion.create') }}"
                                    class="btn btn-sm btn-secondary elevation-2">
                                    Crear <i class="fa fa-book" aria-hidden="true"></i>
                                </a>
                            @endcan
                            @can('is-autor')
                            @else
                                <button
                                    data-toggle="modal" data-target="#reportModal"
                                    class="btn btn-sm btn-outline-secondary elevation-2">
                                    Reporte <i class="fa fa-file" aria-hidden="true"></i>
                                </button>
                            @endcan
                            @can('permiso', 'estado-publicacion-informativa')
                                <a href="{{ route('publicacion.index', [ 'bin' => true]) }}"
                                   class="btn btn-sm btn-outline-danger elevation-2">
                                    Papelera <i class="fa fa-recycle" aria-hidden="true"></i>
                                </a>
                            @endcan
                            @include('publicacion.publicacion.select')
                            @include('publicacion.publicacion.search')

                        @endunless
                        @can('permiso', 'estado-publicacion-informativa')
                            @if($bin)
                                <a href="{{ route('publicacion.index') }}"
                                   class="btn btn-sm btn-outline-success elevation-2">
                                    Lista <i class="fa fa-list" aria-hidden="true"></i>
                                </a>
                            @endif
                        @endcan

                    </div>
                    @error('errorDependencia')
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Mensaje</strong> {{ $message }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    @enderror
                    <div class="row">


                        <div class="col">
                            <div class="card-body pt-2">
                                <div>
                                    @can('permiso', 'buscar-publicacion-informativa')
                                        @unless($bin)
                                            <form action="{{ route('publicacion.index') }}" method="POST"
                                                  class="input-group input-group-sm m-2">
                                                @csrf
                                                @method('GET')
                                                <input name="search" class="form-control form-control-navbar"
                                                       type="search"
                                                       placeholder="Buscar por titulo">
                                                <div class="input-group-append">
                                                    <button class="btn btn-navbar" type="submit">
                                                        <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </form>
                                        @endunless
                                    @endcan
                                </div>
                                <table id="especie-data-table" class="table table-striped table-bordered table-sm"
                                       style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th style="width: 35%;">Titulo</th>
                                        <th>Creado en</th>
                                        <th>Actualizado en</th>
                                        @if($bin)
                                            <th>Eliminado en</th>
                                        @endif
                                        <th>Acciones</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($publicaciones as $publicacion)
                                        <tr>
                                            <td>{{ $publicacion->id }}</td>
                                            <td style="width: 35%;">{{ $publicacion->titulo }}</td>
                                            <td>{{ \Illuminate\Support\Carbon::parse( $publicacion->created_at)->format('d-M-Y') }}</td>
                                            <td>{{ \Illuminate\Support\Carbon::parse( $publicacion->updated_at)->diffForHumans()  }}</td>
                                            @if($bin)
                                                <td>{{ $publicacion->deleted_at }}</td>
                                            @endif
                                            <td>
                                                @if($bin)
                                                    @include('publicacion.publicacion.actionsBin', [ 'data' => $publicacion ])
                                                @else
                                                    @include('publicacion.publicacion.actions', [ 'data' => $publicacion ] )
                                                @endif

                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="pull-right mt-4">
                                    {{ $publicaciones->links() }}
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

    </div>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
                integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
                crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
                integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
                crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                $('#js-example-basic-single').select2();
                $('#js-example-basic-single2').select2();
            });
        </script>
    @endpush
@endsection

