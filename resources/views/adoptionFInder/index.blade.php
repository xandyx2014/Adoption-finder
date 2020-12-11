@extends('layouts.finder')
@section('content-body')
    @if(session()->has('success'))
        <div class="alert alert-success" role="alert">
            Gracias por enviar tu solicitud ❤
        </div>
    @endif
    @if(session()->has('info'))
        <div class="alert alert-warning" role="alert">
            🤔 Ups Has enviado muchas solicitudes a esta publicacion!!
        </div>
    @endif
    @if(session()->has('denuncia'))
        <div class="alert alert-info" role="alert">
            Gracias por enviar tu denuncia <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
        </div>
    @endif
    @error('descripcion')
    <div class="alert alert-warning" role="alert">
        🤔 Ups la descripcion es necesaria!!
    </div>
    @enderror
    @foreach($publicaciones as $publicacion)
        @if($publicacion->mascota != null)
            <div class="card gedf-card elevation-2">
                <div class="card-header bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex justify-content-between align-items-center">
                            {{--<div class="mr-2">
                                <img class="rounded-circle" width="45" src="https://picsum.photos/50/50" alt="">
                            </div>--}}
                            <div class="ml-2">
                                <div class="h5 m-0"># {{ $publicacion->titulo  }}</div>
                                <div class="h7 text-muted">{{ $publicacion->user->name  }}</div>
                            </div>
                        </div>
                        <div>
                            @can('permiso', 'registrar-denuncia')
                                <div class="dropdown">
                                    <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1"
                                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fa fa-ellipsis-h"></i>
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                        <div class="h6 dropdown-header">
                                            <button class="text-muted" data-toggle="modal"
                                                    data-target="#exampleModal-{{$publicacion->id}}">
                                                <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                Denunciar
                                                </a>
                                        </div>
                                        {{--<a class="dropdown-item" href="#">Denunciar esta publicacion</a>--}}

                                    </div>
                                </div>
                            @endcan
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <div class="text-muted h7 mb-2"><i class="fa fa-clock-o"></i> {{ \Illuminate\Support\Carbon::parse( $publicacion->created_at)->diffForHumans() }}
                    </div>
                    {{-- <a class="card-link" href="#">
                         <h5 class="card-title">Lorem ipsum dolor sit amet, consectetur adip.</h5>
                     </a>--}}
                    <p class="card-text">
                        {!!  $publicacion->descripcion_corta !!}
                    </p>
                </div>
                <div class="card-footer">
                    @if($publicacion->mascota != null)
                        @foreach($publicacion->mascota->etiquetas as $etiqueta)
                            <span class="badge badge-primary p-1">{{ $etiqueta->nombre }}</span>
                        @endforeach
                    @endif
                    <br>
                    <a href="{{ route('finder.show', $publicacion->id) }}" class="btn btn-primary  pull-right">
                        <i class="fa fa-paw"
                           aria-hidden="true">
                        </i>
                        Ver
                    </a>
                </div>
            </div>
        @endif
        <!-- Post /////-->
        @include('adoptionFInder.denuncia',
            [
                'data' => $publicacion,
                'tipoDenuncia' => $tipoDenuncia,
                'url' => 'finder.destroy'
            ]
         )
    @endforeach

    <div class="d-flex justify-content-center">
        {{ $publicaciones->links() }}
    </div>
@endsection

