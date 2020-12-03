{{--<a class="btn btn-success elevation-2" href="{{ route('aprobarSolicitud.show', $data->id) }}" >
    <i class="fa fa-eye" aria-hidden="true"></i>
</a>--}}
@can('permiso', 'aprobar-rechazar-solicitud')
    <a class="btn btn-warning elevation-2" href="{{ route('aprobarSolicitud.edit', $data->id) }}">
        <i class="fa fa-check-square-o" aria-hidden="true"></i>
    </a>
@endcan

