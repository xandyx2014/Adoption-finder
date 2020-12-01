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
                <form action="{{ route('bitacora.show', $id) }}" method="GET">
                    @csrf
                    @method('GET')

                    <div class="form-group">
                        <label for="exampleInputPassword1">Desde</label>
                        <input type="date" required name="desde" class="form-control" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Hasta</label>
                        <input type="date" required name="hasta" class="form-control" placeholder="Nombre">
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

