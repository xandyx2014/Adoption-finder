@extends('layouts.app')
@section('title', 'Imagen Publicacion')
@section('content')
    <div class="container-fluid elevation-4">
        <div class="card">
            <div class="card-header d-flex flex-row">
                <div class="text-dark mr-2">
                    Imagen publicacion Total: <span class="badge badge-secondary">{{ $publicaciones->total() }} </span>
                </div>
                <a href="{{ route('imagenPublicacion.index', [ 'estado' => 1]) }}" type="submit"
                   class="btn btn-sm mr-2 btn-success elevation-2">
                    Aprobados
                    <i class="fa fa-check" aria-hidden="true"></i>
                </a>
                <a href="{{ route('imagenPublicacion.index', [ 'estado' => 0]) }}" type="submit"
                   class="btn btn-sm btn-danger elevation-2">
                    Pendientes
                    <i class="fa fa-ban" aria-hidden="true"></i>
                </a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col" style="width: 40%">Imagen</th>
                        <th scope="col">Publicacion</th>
                        <th scope="col">Estado Publicacion</th>
                        <th scope="col">Creado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($publicaciones as $publicacion)
                        <tr>
                            <th scope="row">{{ $publicacion->imagens[0]->id }}</th>
                            <td class="d-flex justify-content-center">
                                @if(Illuminate\Support\Str::contains($publicacion['imagens'][0]['url'], 'http'))
                                    <img class="img-thumbnail elevation-2" src='{{ asset( $publicacion['imagens'][0]['url'] ) }}' alt="" srcset="">
                                @else
                                    <img style="width: 50%" class="img-thumbnail elevation-2" src='{{ asset( "storage/" . $publicacion['imagens'][0]['url'] ) }}' alt=""
                                         srcset="">
                                @endif

                            </td>
                            <td>
                                <a target="_blank" href="{{ route('publicacion.show', $publicacion->id) }}"
                                   class="btn btn-success elevation-2">Ver publicacion</a>
                                <br>
                                @if($publicacion->estado)
                                    <a target="_blank" href="{{ route('blog.show', $publicacion->id) }}"
                                       class="btn btn-outline-success mt-2 elevation-2">Ver en Blog <i class="fa fa-newspaper-o"
                                                                                           aria-hidden="true"></i></a>
                                @endif
                            </td>
                            <td>
                                @unless($publicacion->estado)
                                    <div class="badge badge-danger">
                                        Pendiente
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </div>
                                @endunless
                                @if($publicacion->estado)
                                    <div class="badge badge-success">
                                        Aceptado
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </div>
                                @endif
                            </td>
                            <td>{{ $publicacion->created_at }}</td>
                            <td>
                               {{-- <a class="btn btn-success">
                                    <i class="fa fa-eye" aria-hidden="true"></i>
                                </a>--}}
                                <a href="{{ route('imagenPublicacion.edit', $publicacion->id) }}" class="btn btn-warning elevation-2">
                                    <i class="fa fa-pencil" aria-hidden="true"></i>
                                </a>
                                <form action="{{ route('imagenPublicacion.destroy', $publicacion->imagens[0]->id) }}"
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger elevation-2 mt-1">
                                        <i class="fa fa-recycle" aria-hidden="true"></i>
                                    </button>
                                </form>
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
