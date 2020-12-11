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

                <form class="p-0 pr-0" action="{{ route('mascota.report') }}" method="POST">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <label class="input-group-text" for="inputGroupSelect01">Estado</label>
                            </div>
                            <select class="custom-select" id="estado" name="estado" required>
                                <option value="1" selected>Habilitado</option>
                                <option value="0">Deshabilitado</option>
                            </select>

                        </div>
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
