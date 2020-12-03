@can('permiso', 'consultar-seguimiento-mascota')
    <a class="btn btn-success elevation-2" href="{{ route('seguimiento.show', $data->id) }}">
        <i class="fa fa-eye" aria-hidden="true"></i>
    </a>
@endcan
@can('permiso', 'estado-seguimiento-mascota')
    <form method="POST" action="{{ route('seguimiento.update', $data->id) }}?restore=true" style="display: inline">
        @csrf
        @method('PUT')
        <button type="submit" class="btn btn-success elevation-2">
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
@can('permiso', 'eliminar-seguimiento-mascota')
    <button id="especie-delete-{{$data->id}}" class="btn btn-danger elevation-2">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </button>
@endcan
<script type="application/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        $(document).ready(function () {
            $("#especie-delete-{{$data->id}}").click(async function (e) {
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
                        const {data} = await axios.delete("{{ route('seguimiento.destroy', $data->id) }}?bin=true");
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
    });

</script>
