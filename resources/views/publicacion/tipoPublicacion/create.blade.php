@can('permiso', 'registrar-tipo-publicacion')
    <form class="p-2 pr-0" action="{{ route('tipopublicacion.store') }}" method="POST">
        @csrf
        @method('POST')
        <div class="form-group">
            <label for="inputAddress">Nombre</label>
            <input id="nombre" name="tipo" type="text"
                   class="form-control form-control-sm @error('tipo') is-invalid @enderror"
                   placeholder="Tipo de la publicacion">
            @error('tipo')
            <div class="error invalid-feedback">
                {{ $message }}
            </div>
            @enderror
            <small id="nombre" class="form-text text-muted">
                Esta sera el tipo de la publicacion
            </small>
        </div>
        {{--<div class="form-group">
            <label for="inputAddress2">Descripcion</label>
            <input type="text" name="descripcion" class="form-control form-control-sm @error('descripcion') is-invalid @enderror"
                   id="descripcion" placeholder="Descripcion de la especie">
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
                <button type="submit" class="btn  btn-outline-primary">Crear</button>
            </div>
        </div>

    </form>
@endcan
