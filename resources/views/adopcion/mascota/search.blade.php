<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Busqueda</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('mascota.index') }}" method="GET">
                    @csrf
                    @method('GET')
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Adoptado</label>
                        </div>
                        <select class="custom-select" id="estado" name="adoptado" required>
                            <option value="1" selected>Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Adoptado desde</label>
                        </div>
                        <input type="date" name="adoptado_at" id="">
                    </div>
                    {{--<div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Raza</label>
                        </div>
                        <select class="js-example-basic-single" name="raza">
                            <option value=""></option>
                            @foreach($razas as $raza)
                            <option value="{{ $raza->id }}">{{ $raza->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Especie</label>
                        </div>
                        <select id="especies" class="especies" name="especie">
                            <option value=""></option>
                            @foreach($especies as $especie)
                                <option value="{{ $especie->id }}">{{ $especie->nombre }}</option>
                            @endforeach
                        </select>
                    </div>--}}
                    <button type="submit" class="btn btn-outline-primary">Buscar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>

