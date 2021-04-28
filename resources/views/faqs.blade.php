@extends('layouts.web')
@section('title', 'Adoption Finder')
@section('content')
    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="container">

                    <div class="" id="accordion">
                        <faqs-component pregunta="¿Como envio mi solicitud de adopcion?" descripcion=" Para poder enviar una solicitud, primero debes registrate a la plataforma y ver cual
                                    mascota es de tu gusto y realizar la solicitud de adopcion cual este podra
                                    contactarte una vez aceptada"></faqs-component>
                        <div class="card ">
                            <div class="card-header">
                                <h6 class="card-header text-info">
                                    ¿Como veo las mascotas?
                                </h6>
                            </div>
                            <div>
                                <div class="card-block p-3">
                                    Todas nuestras mascotas se pueden visualizar atravez de nuestra pestaña de <a target="_blank"
                                        href="{{ route('finder.index') }}">BUSCA UNA MASCOTA</a> antes de acceder tienes
                                    que registrarte a nuestra plataforma
                                </div>
                            </div>
                        </div>

                        <div class="card ">
                            <div class="card-header">
                                <h6 class="card-header text-info">
                                    ¿Donde puedo ver el blog informativo?
                                </h6>
                            </div>
                            <div>
                                <div class="card-block p-3">
                                    Nuestro blog informativo puedes verlo en la pestaña de arriba <a
                                        href="{{route('blog.index')}}" target="_blank">BLOG</a> donde podras ver todos las publicaciones
                                    informativas
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('blog.aside')
        </div>
        @push('js')
            <script src="{{ asset('js/spa.js') }}"></script>
        @endpush
    </main>
@endsection
