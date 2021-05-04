@extends('layouts.web')
@section('title', 'Adoption Finder')
@section('content')
    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8 blog-main">
                <h3 class="pb-3 mb-4 font-italic border-bottom">
                    {{ $publicacion->titulo  }}
                </h3>

                <div class="blog-post">
                    <h2 class="blog-post-title">{{ $publicacion->subtitulo  }}</h2>
                    <p class="blog-post-meta"> {{ \Illuminate\Support\Carbon::parse( $publicacion->created_at)->diffForHumans() }} <a
                            href="#">{{ $publicacion->user->name }}</a></p>
                    <div>
                        {!!  $publicacion->cuerpo !!}
                    </div>

                </div><!-- /.blog-post -->




            </div><!-- /.blog-main -->

            @include('blog.aside')<!-- /.blog-sidebar -->

        </div><!-- /.row -->

    </main>
@endsection
