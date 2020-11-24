@extends('layouts.app')
@section('title', 'Imagen Publicacion')
@section('content')
    <div class="container elevation-4">
        <div class="card">
            <div class="card-header b-flex">
                Denuncias | Total :
                <span class="badge badge-secondary">{{ $denuncias->total() }}</span>
                @unless(request()->has('bin'))
                |
                <a href="{{ route('denuncia.index') }}?tipo=1" class="btn btn-sm btn-primary elevation-2 elevation-2">
                    <div class="text-light">Publicacion Informativa</div>
                </a>
                |
                <a href="{{ route('denuncia.index') }}?tipo=0" class="btn btn-sm btn-warning elevation-2 elevation-2">
                    <div class="text-light">Publicacion Mascotas</div>
                </a>

                |
                <button
                    data-toggle="modal" data-target="#reportModal"
                    class="btn btn-sm btn-outline-secondary elevation-2">
                    Reporte <i class="fa fa-file" aria-hidden="true"></i>
                </button>
                @include('denuncia.denuncia.select')

                    |
                <a href="{{ route('denuncia.index', [ 'bin' => true]) }}"
                   class="btn btn-sm btn-outline-danger elevation-2">
                    Papelera <i class="fa fa-recycle" aria-hidden="true"></i>
                </a>
                @endunless
                |
                @if(request()->has('bin'))
                    <a href="{{ route('denuncia.index') }}?tipo=1" class="btn btn-sm btn-outline-success elevation-2">
                        Lista <i class="fa fa-list" aria-hidden="true"></i>
                    </a>
                @endif
            </div>
            <div class="card-body">
                <table class="table table-sm  table-striped">
                    <thead>
                    <tr>
                        <th scope="col" style="width: 10%">ID</th>
                        <th scope="col" style="width: 45%">Descripcion</th>
                        <th scope="col">Creado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($denuncias as $denuncia)
                        <tr>
                            <td>{{ $denuncia->id }}</td>
                            <th>{{ $denuncia->descripcion }}</th>
                            <td>{{ $denuncia->created_at }}</td>
                            <td>
                                <a class="btn btn-success elevation-2" href="{{ route('denuncia.show', $denuncia->id) }}" >
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>
                                @unless(request()->has('bin'))
                                <form method="POST" action="{{ route('denuncia.destroy', $denuncia->id) }}" style="display: inline">
                                    @csrf
                                    @method('DELETE')
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                    <button type="submit" class="btn btn-danger elevation-2">
                                        <i class="fa fa-recycle" aria-hidden="true"></i>
                                    </button>
                                </form>
                                @endunless
                                @if(request()->has('bin'))
                                    @include('denuncia.denuncia.actionsBin', [ 'data' => $denuncia])
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="pull-right">
                    {{ $denuncias->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
