@extends('layouts.web')
@section('title', 'Adoption Finder')
@section('content')
    <main role="main" class="container">
        <div class="row">
            <div class="col-md-8">
                <div class="container elevation-1 p-4">
                    <h5>Acerca de nosotros</h5>
                    <p>
                        Adoption finder tiene la ilusión de dar mascotas en adopcion  para que existan padres adoptantes, nos damos cuenta de que podemos
                        unificar la información de para el proceso de adopción ofreciéndola a otras
                        personas que también pudiesen necesitarla.

                        De ahí nace la idea de crear esta plataform cuya finalidad principal es precisamente la de
                        poder informar, todas esas personas que tienen la intención de  adoptar.
                    </p>
                </div>
            </div>
            @include('blog.aside')
        </div>

    </main>
@endsection
