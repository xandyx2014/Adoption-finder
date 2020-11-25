@extends('layouts.app')
@section('title', 'Especie')
@section('content')
    @push('css')
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css"
              integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw=="
              crossorigin="anonymous"/>
    @endpush
    <div class="container elevation-4">
        <div class="card">
            <div class="card-header">
                Mascotas
                @unless(request()->input('bin'))
                    <button type="button" class="btn btn-sm btn-secondary elevation-2" data-toggle="modal"
                            data-target="#searchModal">
                        Busqueda
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                    <a
                        href="{{ route('mascota.index') }}"
                        class="btn btn-sm btn-outline-secondary elevation-2">
                        Limpiar busqueda
                        <i class="fa fa-ban" aria-hidden="true"></i>
                    </a>
                    @include('adopcion.mascota.search')
                    <a
                        href="{{ route('mascota.create') }}"
                        class="btn btn-sm btn-secondary elevation-2">
                        Crear <i class="fa fa-book" aria-hidden="true"></i>
                    </a>
                    <button
                        data-toggle="modal" data-target="#reportModal"
                        class="btn btn-sm btn-outline-secondary elevation-2">
                        Reporte <i class="fa fa-file" aria-hidden="true"></i>
                    </button>
                    <a href="{{ route('mascota.index', [ 'bin' => true]) }}"
                       class="btn btn-sm btn-outline-danger elevation-2">
                        Papelera <i class="fa fa-recycle" aria-hidden="true"></i>
                    </a>
                    @include('adopcion.mascota.select')
                @endunless
                @if(request()->input('bin'))
                    <a href="{{ route('mascota.index') }}" class="btn btn-sm btn-outline-success elevation-2">
                        Lista <i class="fa fa-list" aria-hidden="true"></i>
                    </a>
                @endif
            </div>
            <div class="card-body">
                @unless(request()->input('bin'))
                    <form action="{{ route('mascota.index') }}" method="GET"
                          class="input-group input-group-sm m-2">
                        @csrf
                        @method('GET')
                        <input name="search" class="form-control form-control-navbar" type="search"
                               placeholder="Buscar por nombre">
                        <div class="input-group-append">
                            <button class="btn btn-navbar" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                @endunless
                <table class="table table-sm">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Adoptado</th>
                        <th scope="col">Creado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($seguimientos as $mascota)
                        <tr>
                            <th scope="row">{{ $mascota->id }}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                    {{ $seguimientos->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
    @push('js')
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"
                integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A=="
                crossorigin="anonymous"></script>
        <script>
            $(document).ready(function () {
                $('.js-example-basic-single').select2();
                $('#especies').select2();
            });
        </script>
    @endpush
@endsection
