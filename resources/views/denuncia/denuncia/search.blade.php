<div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('denuncia.index') }}" method="GET">
                    @csrf
                    @method('GET')
                    <div class="form-group">
                        <label>Tipo</label>
                            <select  style="width: 100%;" id="js-example-basic-single" class="form-control select2-selection select2-selection--single" name="tipo">
                                <option style="padding: 5px;" value="1">Publicacion Informativa</option>
                                <option style="padding: 5px;" value="0">Publicacion Mascotas</option>

                                {{--@foreach($users as $user)
                                    <option style="padding: 5px;" value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach--}}
                            </select>
                    </div>

                    <button type="submit" class="btn btn-outline-primary">Buscar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

            </div>
        </div>
    </div>
</div>
