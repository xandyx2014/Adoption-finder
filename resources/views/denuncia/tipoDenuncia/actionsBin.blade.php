@can('permiso', 'consultar-tipo-denuncia')
<a class="btn btn-success" href="{{ route('tipodenuncia.show', $id) }}">
    <i class="fa fa-eye" aria-hidden="true"></i>
</a>
@endcan
@can('permiso', 'estado-tipo-denuncia')
<form method="POST" action="{{ route('tipodenuncia.update', $id) }}?restore=true" style="display: inline">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-success">
        <i class="fa fa-recycle" aria-hidden="true"></i>
    </button>
</form>
@endcan
{{--<form method="POST" action="{{ route('especie.destroy', $id) }}?bin=true" style="display: inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </button>
</form>--}}
@can('permiso', 'eliminar-tipo-denuncia')
<button id="especie-delete-{{$id}}" class="btn btn-danger">
    <i class="fa fa-trash" aria-hidden="true"></i>
</button>
@endcan
<script>
    $(document).ready(function () {
        $("#especie-delete-{{$id}}").click(async function (e) {
            Swal.fire({
                title: '¿Estas seguro de eliminarlo?',
                text: "Esta accion lo eliminara permanentemente.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, borrar!'
            }).then(async (result) => {
                if (result.isConfirmed) {
                    const {data} = await axios.delete("{{ route('tipodenuncia.destroy', $id) }}?bin=true");
                    if (typeof data.message === 'undefined') {
                        Swal.fire(
                            'Borrar!',
                            data.error,
                            'error'
                        )
                    } else {
                        Swal.fire(
                            'Borrar!',
                            data.message,
                            'success'
                        );
                        location.reload();
                    }
                }
            })
        });
    });
</script>
