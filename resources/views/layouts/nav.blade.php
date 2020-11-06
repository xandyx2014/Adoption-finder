<nav class="col-md-2 d-none d-md-block bg-white sidebar">
    <div class="sidebar-sticky">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('init') }}" target="_blank">
                    <i class="fa fa-globe" aria-hidden="true"></i>
                    Ver Pagina
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link active" href="{{ route('init') }}" target="_blank">
                    <i class="fa fa-newspaper-o" aria-hidden="true"></i>
                    Ver Blog
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
            <li class="nav-item">
                <a class="nav-link active" href="#">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    Dashboard
                </a>
            </li>
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
                <a class="nav-link" href="#">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    Current month
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
                <a class="nav-link" href="#">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    Current month
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
                <a class="nav-link" href="#">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    Current month
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
                <a class="nav-link" href="#">
                    <i class="fa fa-book" aria-hidden="true"></i>
                    Current month
                </a>
            </li>
        </ul>
    </div>
</nav>
