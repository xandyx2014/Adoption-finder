@extends('layouts.app')
@section('title', 'Hogar')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-3">
                                <div class="card">
                                    <div class="card-body">
                                        <form>
                                            <div class="form-group">
                                                <label for="inputAddress">Nombre</label>
                                                <input id="nombre" type="text" class="form-control"  placeholder="1234 Main St">
                                                <small id="nombre" class="form-text text-muted">
                                                    Este nombre sera para identificar el Especie.
                                                </small>
                                            </div>
                                            <div class="form-group">
                                                <label for="inputAddress2">Descripcion</label>
                                                <input type="text" class="form-control" id="descripcion" placeholder="Apartment, studio, or floor">
                                                <small id="descripcion" class="form-text text-muted">
                                                    Este nombre sera para identificar el Especie.
                                                </small>
                                            </div>

                                            <div class="form-group row">
                                                <div class="col-sm-10">
                                                    <button type="submit" class="btn btn-primary">Sign in</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
