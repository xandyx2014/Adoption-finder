@extends('layouts.app')
@section('title', 'Imagen Publicacion')
@section('content')
    <div class="container-fluid elevation-4">
        <div class="card">
            <div class="card-header d-flex flex-row">
                <div class="text-dark mr-2">
                    Imagen Mascotas Total: <span class="badge badge-secondary">{{ $publicaciones->total() }} </span>
                </div>
                <a href="{{ route('imagenMascota.index', [ 'adoptado' => 1]) }}" type="submit"
                   class="btn btn-sm mr-2 btn-success elevation-2">
                    Adoptado
                    <i class="fa fa-check" aria-hidden="true"></i>
                </a>
                <a href="{{ route('imagenMascota.index', [ 'adoptado' => 0]) }}" type="submit"
                   class="btn btn-sm btn-danger elevation-2">
                    No adoptados
                    <i class="fa fa-ban" aria-hidden="true"></i>
                </a>
            </div>
            <div class="card-body">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col" style="width: 40%">Imagenes</th>
                        <th scope="col">Nombre mascota</th>
                        <th scope="col">Estado de adopcion</th>
                        <th scope="col">Creado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($publicaciones as $publicacion)
                        <tr>
                            <th scope="row">{{ optional($publicacion)->id }}</th>
                            <td class="d-flex justify-content-center">

                                @forelse($publicacion->imagens as $imagen)
                                    @if($loop->first)
                                        @if(Illuminate\Support\Str::contains($imagen->url, 'http'))
                                            <img class="img-thumbnail elevation-2" src='{{ asset( $imagen->url ) }}'
                                                 alt="" srcset="">
                                        @else
                                            <img style="width: 50%" class="img-thumbnail elevation-2"
                                                 src='{{ asset( "storage/" . $imagen->url ) }}' alt=""
                                                 srcset="">
                                        @endif
                                    @endif
                                @empty
                                    <img style="width: 50%" class="img-thumbnail elevation-2"
                                         src='{{ asset( "storage/default.jpg") }}' alt=""
                                         srcset="">
                                @endforelse

                            </td>
                            <td>
                                {{ $publicacion->nombre }}
                            </td>
                            <td>
                                @unless($publicacion->adoptado)
                                    <div class="badge badge-danger">
                                        No adoptado
                                        <i class="fa fa-times" aria-hidden="true"></i>
                                    </div>
                                @endunless
                                @if($publicacion->adoptado)
                                    <div class="badge badge-success">
                                        Adoptado
                                        <i class="fa fa-check" aria-hidden="true"></i>
                                    </div>

                                @endif
                            </td>
                            <td>{{ $publicacion->created_at }}</td>
                            <td>
                                {{-- <a class="btn btn-success">
                                     <i class="fa fa-eye" aria-hidden="true"></i>
                                 </a>--}}
                                <a href="{{ route('imagenMascota.edit', $publicacion->id) }}"
                                   class="btn btn-warning elevation-2">
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
