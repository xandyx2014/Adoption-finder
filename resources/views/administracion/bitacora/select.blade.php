<div class="modal fade" id="reportModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reporte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form class="p-0 pr-0" action="{{ route('bitacora.report') }}" method="POST">
                    @csrf
                    @method('POST')
                    <input type="text" hidden name="user" value="{{ $id }}">
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Estado</label>
                            </div>
                            <select class="custom-select" id="estado" name="estado" required>
                                <option value="1" selected>Habilitado</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Desde</label>
                        <input type="datetime-local" required name="desde" class="form-control" placeholder="Nombre">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Hasta</label>
                        <input type="datetime-local" required name="hasta" class="form-control" placeholder="Nombre">
                    </div>

                    <button type="submit" class="btn btn-sm btn-outline-primary">Preparar <i class="fa fa-file-pdf-o"
                                                                                             aria-hidden="true"></i>
                    </button>

                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

            </div>
        </div>
    </div>
</div>
