@extends('layouts.web')
@section('title', 'Adoption Finder')
@section('content')
    @push('css')
        <style>
            .jumbotron {
                background-image: url("{{ asset('storage/default/welcome.jpg') }}");
                background-position: center;
            }
        </style>
        @endpush
    <div class="jumbotron p-3 p-md-5 text-white rounded bg-dark">
        <div class="col-md-6 px-0 elevation-4 p-4 bg-primary rounded">
            <h1 class="display-4 font-italic">Adoption Finder dando mascotas</h1>
            <p class="lead my-3">Una plataforma para publicar adopciones y encontrar tu mascota ideal para adoptar</p>
            <p class="lead mb-0"><a href="{{ route('finder.index') }}" class="text-white font-weight-bold">Buscar mascotas...</a></p>
        </div>
    </div>
    <div class="row d-flex justify-content-center  border-bottom mb-3">
        <h5 class="text-muted ">Algunas de nuestras mascotas</h5>
    </div>
    <div class="row mb-2">
        <div class="col-md-3">
            <div class="card">

                <img class="card-img-top" data-src="holder.js/150x150?theme=thumb"
                     alt="Thumbnail [200x250]"
                     src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_175519bb0e8%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_175519bb0e8%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2259.5%22%20y%3D%22130.7%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                     data-holder-rendered="true">
                <div class="card-footer">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">

                <img class="card-img-top" data-src="holder.js/150x150?theme=thumb"
                     alt="Thumbnail [200x250]"
                     src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_175519bb0e8%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_175519bb0e8%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2259.5%22%20y%3D%22130.7%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                     data-holder-rendered="true">
                <div class="card-footer">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">

                <img class="card-img-top" data-src="holder.js/150x150?theme=thumb"
                     alt="Thumbnail [200x250]"
                     src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%22200%22%20height%3D%22250%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%20200%20250%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_175519bb0e8%20text%20%7B%20fill%3A%23eceeef%3Bfont-weight%3Abold%3Bfont-family%3AArial%2C%20Helvetica%2C%20Open%20Sans%2C%20sans-serif%2C%20monospace%3Bfont-size%3A13pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_175519bb0e8%22%3E%3Crect%20width%3D%22200%22%20height%3D%22250%22%20fill%3D%22%2355595c%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2259.5%22%20y%3D%22130.7%22%3EThumbnail%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E"
                     data-holder-rendered="true">
                <div class="card-footer">
                    <h5 class="card-title">Card title</h5>
                    <p class="card-text">Some quick example text to build on the card title and make up the bulk of the
                        card's content.</p>
                    <a href="#" class="btn btn-primary">Go somewhere</a>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">

                <div class="card-body">
                    <h5 class="card-title">
                        <h5 class="my-0 mr-md-auto font-weight-normal">
                            <i class="fa fa-paw" aria-hidden="true"></i>
                            Nuestro blog <i class="fa fa-paw" aria-hidden="true"></i>
                        </h5>
                    </h5>
                    <p class="card-text">
                       Conoce nuestro blog para que estes muy informado sobre nuestras publicaciones informativas
                    </p>

                </div>
                <div class="card-footer d-flex justify-content-center">
                    <a href="#" class="btn btn-primary">Ir al Blog...🤍</a>
                </div>
            </div>
        </div>
    </div>
    <main role="main" class="container-fluid">
        <div class="row">
            <div class="col">
                <div class="row d-flex justify-content-center  border-bottom mb-3">
                    <h5 class="text-muted ">Sobre nosotros</h5>
                </div>
                <div class="card  d-flex p-4 flex-md-row flex-sm-column justify-content-around">
                    <div style="width: 250px;" class="bg-primary elevation-4">
                        <div class="card-footer mt-1 d-flex flex-column justify-content-center align-items-center">
                            <h5 class="card-title text-center">Publicaciones de mascotas</h5>
                            <img src="{{ asset('storage/default/welcome-1.png') }}" alt="">
                            <p class="card-text text-light text-center">
                                Conoce nuestra publicaciones para ver las mascotas que estan disponibles
                            </p>
                            <a href="{{ route('finder.index') }}" class="btn btn-outline-light">Ver publicaciones</a>
                        </div>
                    </div>
                    <div style="width: 250px;">
                        <div class="card-footer elevation-1 mt-1 d-flex flex-column justify-content-center align-items-center">
                            <h5 class="card-title">Nuestro Blog</h5>
                            <img src="{{ asset('storage/default/blog.png') }}" alt="">
                            <p class="card-text text-secondary">
                                Conoce nuestro blog para mantenerte al dia sobre las publicaciones informativas para tu mascota
                            </p>
                            <a href="{{ route('blog.index') }}" class="btn btn-outline-primary">Ir al blog</a>
                        </div>
                    </div>
                    <div style="width: 250px;">
                        <div class="card-footer mt-1 d-flex flex-column justify-content-center align-items-center">
                            <h5 class="card-title">¿Tienes dudas?</h5>
                            <img src="{{ asset('storage/default/problem.png') }}" alt="">
                            <p class="card-text text-secondary">
                                Si tienes preguntas o dudas puedes visitar nuestro listado de preguntas frecuentas para poder resolver
                            </p>
                            <a href="{{ url('faqs') }}" class="btn btn-outline-primary">Ir a preguntas</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
    @push('js')

        <script type="text/javascript">
            console.log('Hola');
            var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
            (function () {
                var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
                s1.async = true;
                s1.src = 'https://embed.tawk.to/5fc711efa1d54c18d8ef7556/default';
                s1.charset = 'UTF-8';
                s1.setAttribute('crossorigin', '*');
                s0.parentNode.insertBefore(s1, s0);
            })();
        </script>

    @endpush
@endsection
