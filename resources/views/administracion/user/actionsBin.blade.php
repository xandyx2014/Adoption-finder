<a class="btn btn-success" href="{{ route('user.show', $data->id) }}">
    <i class="fa fa-eye" aria-hidden="true"></i>
</a>
<form method="POST" action="{{ route('user.update', $data->id) }}?restore=true" style="display: inline">
    @csrf
    @method('PUT')
    <button type="submit" class="btn btn-success">
        <i class="fa fa-recycle" aria-hidden="true"></i>
    </button>
</form>
{{--<form method="POST" action="{{ route('especie.destroy', $id) }}?bin=true" style="display: inline">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn btn-danger">
        <i class="fa fa-trash" aria-hidden="true"></i>
    </button>
</form>--}}
<button id="especie-delete-{{$data->id}}" class="btn btn-danger">
    <i class="fa fa-trash" aria-hidden="true"></i>
</button>
<script type="application/javascript">
    document.addEventListener('DOMContentLoaded', () => {
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
                    const {data} = await axios.delete("{{ route('user.destroy', $data->id) }}?bin=true");
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
    /*$(document).ready(function () {

    });*/
</script>
