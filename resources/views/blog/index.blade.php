@extends('layouts.web')
@section('title', 'Adoption Finder')
@section('content')
    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    Nuestro Blog
                </h3>
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
                    <div class="card flex-md-row mb-4 box-shadow h-md-250 elevation-2">
                        <div class="card-body d-flex flex-column align-items-start">
                            <div class="d-flex justify-content-between align-items-center w-100">
                                <strong class="d-inline-block mb-2 text-primary">
                                    {{ optional($publicacion->tipoPublicacion)->tipo }}
                                </strong>
                                <div>
                                    <div class="dropdown">
                                        <button class="btn btn-link dropdown-toggle" type="button" id="gedf-drop1"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        </button>
                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="gedf-drop1">
                                            <div class="h6 dropdown-header">
                                                <button class="btn btn-outline-primary text-muted" data-toggle="modal"
                                                        data-target="#exampleModal-{{$publicacion->id}}">
                                                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                                                    Denunciar
                                                    </a>
                                            </div>
                                            {{--<a class="dropdown-item" href="#">Denunciar esta publicacion</a>--}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h3 class="mb-0">
                                <a class="text-dark"
                                   href="{{ route('blog.show', $publicacion->id) }}">{{ Illuminate\Support\Str::substr($publicacion->titulo, 0 , 20) }}
                                    ...</a>
                            </h3>
                            <div class="mb-1 text-muted">{{ $publicacion->created_at }}</div>
                            <p class="card-text mb-auto">
                                {{ Illuminate\Support\Str::substr($publicacion->subtitulo, 0 , 200) }}...
                            </p>
                            <a href="{{ route('blog.show', $publicacion->id)  }}">Continuar leyendo</a>
                        </div>
                        @if(Illuminate\Support\Str::contains($publicacion['imagens'][0]['url'], 'http'))
                            <img class="img-thumbnail card-img-right flex-auto d-none d-md-block"
                                 src='{{ asset( $publicacion['imagens'][0]['url'] ) }}' alt="" srcset="">
                        @else
                            <img style="max-width: 250px" class=" img-thumbnail card-img-right img-fluid flex-auto d-none d-md-block"
                                 src='{{ asset( "storage/" . $publicacion['imagens'][0]['url'] ) }}' alt=""
                                 srcset="">
                        @endif
                        {{-- <img src="{{ asset($publicacion->imagens[0]->url) }}" class=""  style="width: 200px; height: 250px;"data-holder-rendered="true">--}}
                        {{--<img class="card-img-right flex-auto d-none d-md-block" data-src="holder.js/200x250?theme=thumb" alt="Thumbnail [200x250]" style="width: 200px; height: 250px;" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_175edf369e1%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_175edf369e1%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2259.5%22%20y%3D%22130.7%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" data-holder-rendered="true">--}}
                    </div>
                    @include('adoptionFInder.denuncia',
                            [
                                'data' => $publicacion,
                                'tipoDenuncia' => $tipoDenuncia,
                                'url' => 'blog.destroy'
                            ]
                         )
                @endforeach
                <div class="pull-right">
                    {{ $publicaciones->links() }}
                </div>
            </div>

        @include('blog.aside')<!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </main>
@endsection
