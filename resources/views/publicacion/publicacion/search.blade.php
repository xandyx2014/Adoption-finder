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
                <form action="{{ route('publicacion.index') }}" method="POST">
                    @csrf
                    @method('GET')
                    <div class="form-group">
                        <label>Por Usuario</label>
                            <select  style="width: 100%;" id="js-example-basic-single" class="form-control select2-selection select2-selection--single" name="usuario">
                                <option style="padding: 5px;" value="x"></option>
                                @foreach($users as $user)
                                    <option style="padding: 5px;" value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                            </select>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label>Por Tipo de publicacion</label>
                            <select  style="width: 100%;" id="js-example-basic-single2" class="form-control select2-selection select2-selection--single" name="tipo">
                                <option style="padding: 5px;" value="x"></option>
                                @foreach($tipos as $tipo)
                                    <option style="padding: 5px;" value="{{ $tipo->id }}">{{ $tipo->tipo }}</option>
                                    @endforeach
                            </select>
                        <!-- /.input group -->
                    </div>
                    <div class="form-group">
                        <label> Creado desde</label>
                        <input type="date" name="desde" class="form-control">

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
