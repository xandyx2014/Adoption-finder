
<form class="p-2 pr-0" action="{{ route('etiqueta.store') }}" method="POST">
    @csrf
    @method('POST')
    <div class="form-group">
        <label for="inputAddress">Nombre</label>
        <input id="nombre" name="nombre" type="text" class="form-control form-control-sm @error('nombre') is-invalid @enderror"
               placeholder="nombre de la etiqueta">
        @error('nombre')
        <div class="error invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <small id="nombre" class="form-text text-muted">
            Este nombre sera para identificar el Etiqueta.
        </small>
    </div>
    {{--<div class="form-group">
        <label for="inputAddress2">Descripcion</label>
        <input type="text" name="descripcion" class="form-control form-control-sm @error('descripcion') is-invalid @enderror"
               id="descripcion" placeholder="Descripcion de la etiqueta">
        @error('descripcion')
        <div class="error invalid-feedback">
            {{ $message }}
        </div>
        @enderror
        <small id="descripcion" class="form-text text-muted">
            Esto describira las caracteristicas y propiedades.
        </small>

    </div>--}}

    <div class="form-group row">
        <div class="col">
            <button type="submit" class="btn  btn-outline-primary elevation-2">Crear</button>
        </div>
    </div>
</form>
