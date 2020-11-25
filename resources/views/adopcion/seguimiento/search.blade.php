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
                <form action="{{ route('seguimiento.index') }}" method="GET">
                    @csrf
                    @method('GET')
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <label class="input-group-text" for="inputGroupSelect01">Adoptado</label>
                        </div>
                        <select class="custom-select" id="estado" name="adoptado">
                            <option value="" selected></option>
                            <option value="1">Si</option>
                            <option value="0">No</option>
                        </select>
                    </div>
                    <div class="input-group mb-3">
                        <label >Mascota</label>
                        <select style="width: 100%" class="custom-select w-100" id="mascotas" name="mascota">
                            <option value="" selected></option>
                            @foreach($mascotas as $mascota)
                                <option value="{{ $mascota->id }}"> {{ $mascota->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Buscar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>

