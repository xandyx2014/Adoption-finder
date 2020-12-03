<nav class="col-md-2 d-none d-md-block bg-white card">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ url('home') }}">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Hogar
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('init') }}" target="_blank">
                    <i class="fa fa-globe" aria-hidden="true"></i>
                    Ver Pagina
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('blog.index') }}" target="_blank">
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    Ver Blog
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('finder.index') }}" target="_blank">
                    <i class="fa fa-paw" aria-hidden="true"></i>
                    Ver publicaciones adopcion
                </a>
            </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-2 mb-1 text-muted">
            <span>Gestion adopcion</span>
            <a class="d-flex align-items-center text-muted" href="#" data-toggle="collapse"
               data-target="#adopcion">
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </a>
        </h6>
        <ul class="nav flex-column collapse" id="adopcion">
            @can('permiso', 'listar-mascota')
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('mascota.index') }}">
                        <i class="fa fa-paw" aria-hidden="true"></i>
                        Mascotas
                    </a>
                </li>
            @endcan
            @can('permiso', 'listar-publicacion-adopcion')
                <a class="nav-link" href="{{ route('publicacionAdopcion.index') }}">
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    Publicaciones de adopcion
                </a>
            @endcan
            @can('permiso', 'listar-galeria-mascota')
                <a class="nav-link" href="{{ route('imagenMascota.index') }}">
                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                    Galeria de fotos de mascota
                </a>
            @endcan
            @can('permiso', 'listar-seguimiento-mascota')
                <a class="nav-link" href="{{ route('seguimiento.index') }}">
                    <i class="fa fa-history" aria-hidden="true"></i>
                    Seguimiento de mascota
                </a>
            @endcan
            @can('permiso', 'listar-solicitud-adopcion')
                <a class="nav-link" href="{{ route('solicitud.index') }}">
                    <i class="fa fa-question" aria-hidden="true"></i>
                    Solicitud de adopcion
                </a>
            @endcan
            @can('permiso', 'listar-aprobar-rechazar-solicitud')
                <a class="nav-link" href="{{ route('aprobarSolicitud.index') }}">
                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                    Aprobar | Rechazar solicitud de adopcion
                </a>
            @endcan

        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
            <span>Gestion publicaciones informativas</span>
            <a class="d-flex align-items-center text-muted" href="#" data-toggle="collapse"
               data-target="#publicacion">
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </a>
        </h6>
        <ul class="nav flex-column collapse" id="publicacion">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tipopublicacion.index') }}">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    Tipo de publicacion
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('publicacion.index') }}">
                    <i class="fa fa-rss" aria-hidden="true"></i>
                    Publicaciones informativas
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('aprobar.index') }}">
                    <i class="fa fa-check-square-o" aria-hidden="true"></i>
                    Aprobar | Rechazar publicacion
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('imagenPublicacion.index') }}">
                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                    Galeria de fotos
                </a>
            </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
            <span>Gestion de denuncias</span>
            <a class="d-flex align-items-center text-muted" href="#" data-toggle="collapse"
               data-target="#denuncia">
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </a>
        </h6>
        <ul class="nav flex-column collapse" id="denuncia">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('tipodenuncia.index') }}">
                    <i class="fa fa-exclamation-triangle" aria-hidden="true"></i>
                    Tipo de denuncia
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('denuncia.index') }}">
                    <i class="fa fa-bell" aria-hidden="true"></i>
                    Denuncias
                </a>
            </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
            <span>Parametros</span>
            <a class="d-flex align-items-center text-muted" href="#" data-toggle="collapse"
               data-target="#parametros">
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </a>
        </h6>
        <ul class="nav flex-column collapse" id="parametros">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('especie.index') }}">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    Especie
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('raza.index') }}">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    Raza
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('etiqueta.index') }}">
                    <i class="fa fa-tags" aria-hidden="true"></i>
                    Etiqueta
                </a>
            </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
            <span>Reportes</span>
            <a class="d-flex align-items-center text-muted" href="#" data-toggle="collapse"
               data-target="#reportes">
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </a>
        </h6>
        <ul class="nav flex-column collapse" id="reportes">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reporteMascota.index') }}">
                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                    Reporte de mascota para la adopcion
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('reporteSeguimiento.index') }}">
                    <i class="fa fa-file-text-o" aria-hidden="true"></i>
                    Reporte de seguimiento de mascota
                </a>
            </li>
        </ul>
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-3 mb-1 text-muted">
            <span>Adm usuario, auditoria</span>
            <a class="d-flex align-items-center text-muted" href="#" data-toggle="collapse"
               data-target="#administracion">
                <i class="fa fa-angle-down" aria-hidden="true"></i>
            </a>
        </h6>
        <ul class="nav flex-column collapse" id="administracion">
            <li class="nav-item">
                <a class="nav-link" href="{{ route('user.index') }}">
                    <i class="fa fa-users" aria-hidden="true"></i>
                    Gestionar usuario
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('rol.index') }}">
                    <i class="fa fa-user" aria-hidden="true"></i>
                    Gestionar Rol
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('permiso.index') }}">
                    <i class="fa fa-shield" aria-hidden="true"></i>
                    Administrar permisos
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('bitacora.index') }}">
                    <i class="fa fa-history" aria-hidden="true"></i>
                    Administrar bitacora
                </a>
            </li>
        </ul>

    </div>
</nav>
