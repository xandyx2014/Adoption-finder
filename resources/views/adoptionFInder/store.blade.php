<form action="{{ route('finder.store') }}" method="POST">
    @csrf
    @method('POST')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Solcitud de mascota 🎉</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="text" name="id" value="{{ $data->id }}" hidden>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Motivo</label>
                        <input type="text" name="motivo" required class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Descripcion</label>
                        <textarea name="descripcion" class="form-control" rows="3" placeholder="Enter ..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-success">Solicitar</button>
                </div>
            </div>
        </div>
    </div>
</form>
