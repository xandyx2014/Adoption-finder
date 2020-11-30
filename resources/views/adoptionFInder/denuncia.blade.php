<form action="{{ route('finder.destroy', $data->id) }}" method="post">
    @csrf
    @method('DELETE')
<div class="modal fade" id="exampleModal-{{$data->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Tipo de denuncia</label>
                    <select class="form-control" name="tipo">
                        @foreach($tipoDenuncia as $tipo)
                        <option value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                         @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Descripcion</label>
                    <textarea required class="form-control" name="descripcion" rows="3" placeholder="Descripcion ..."></textarea>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                <button type="submit" class="btn btn-danger">Enviar denuncia</button>
            </div>
        </div>
    </div>
</div>
</form>
