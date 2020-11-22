@extends('layouts.app')
@section('title', 'Especie')
@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">


                <b>Total Pendientes :</b> <span class="badge badge-warning mr-2">{{ $publicaciones->total() }}</span>
                <div class="d-flex">
                    <a href="{{ route('aprobar.index', [ 'estado' => 1]) }}" type="submit"
                       class="btn btn-sm mr-2 btn-success">
                        Aprobados
                        <i class="fa fa-check" aria-hidden="true"></i>
                    </a>
                    <a href="{{ route('aprobar.index', [ 'estado' => 0]) }}" type="submit"
                       class="btn btn-sm btn-danger">
                        Pendiestes
                        <i class="fa fa-ban" aria-hidden="true"></i>
                    </a>
                </div>
            </div>


        </div>

        <div class="card-body">
            <table class="table table-sm">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col" style="width: 45%">Titulo</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Creado en</th>
                    <th scope="col">Actualizado en</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($publicaciones as $publicacion)
                    <tr>
                        <th scope="row">{{ $publicacion->id }}</th>
                        <td>{{ $publicacion->titulo }}</td>
                        <td>
                            @if($publicacion->estado)

                                Aceptado
                                <i class="fa fa-check text-success" aria-hidden="true"></i>

                            @else

                                Pendieste
                                <i class="fa fa-ban text-danger" aria-hidden="true"></i>

                            @endif
                        </td>
                        <td>{{ $publicacion->created_at }}</td>
                        <td>{{ $publicacion->updated_at }}</td>
                        <td>
                            @unless($publicacion->estado)
                                <form class="btn btn-success" action="{{ route('aprobar.update', $publicacion->id) }}?cambiar=1" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit">
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </button>
                                </form>
                            @endunless
                            @if($publicacion->estado)
                                    <form class="btn btn-danger" action="{{ route('aprobar.update', $publicacion->id) }}?cambiar=0" method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit">
                                            <i class="fa fa-times" aria-hidden="true"></i>
                                        </button>
                                    </form>
                            @endif
                            <form method="POST" action="{{ route('publicacion.destroy', $publicacion->id) }}"
                                  style="display: inline">
                                @csrf
                                @method('DELETE')
                                <meta name="csrf-token" content="{{ csrf_token() }}">
                                <button type="submit" class="btn btn-danger">
                                    <i class="fa fa-recycle" aria-hidden="true"></i>
                                </button>
                            </form>
                            <a class="btn btn-success" href="{{ route('publicacion.show', $publicacion->id) }}">
                                <i class="fa fa-eye" aria-hidden="true"></i>
                            </a>

                            <a class="btn btn-warning" href="{{ route('publicacion.edit', $publicacion->id) }}">
                                <i class="fa fa-pencil" aria-hidden="true"></i>
                            </a>


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
