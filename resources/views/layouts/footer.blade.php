<footer class="container py-5">
    <div class="row">
        <div class="col-12 col-md">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                 stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                 class="d-block mb-2">
                <circle cx="12" cy="12" r="10"></circle>
                <line x1="14.31" y1="8" x2="20.05" y2="17.94"></line>
                <line x1="9.69" y1="8" x2="21.17" y2="8"></line>
                <line x1="7.38" y1="12" x2="13.12" y2="2.06"></line>
                <line x1="9.69" y1="16" x2="3.95" y2="6.06"></line>
                <line x1="14.31" y1="16" x2="2.83" y2="16"></line>
                <line x1="16.62" y1="12" x2="10.88" y2="21.94"></line>
            </svg>
            <small class="d-block mb-3 text-muted">© Bolivia {{ now()->format('yy') }}</small>
        </div>
        <div class="col-6 col-md">
            <h5 class="text-primary">Paginas</h5>
            <ul class="list-unstyled text-small">
                <li>
                    <a class="text-muted" href="{{ route('blog.index') }}">Blog</a>
                </li>
                <li>
                    <a class="text-muted" href="{{ route('finder.index') }}">Busca una mascota</a>
                </li>
                <li>
                    <a class="text-muted" href=" {{ route('fasqs') }}">Preguntas frecuentes</a>
                </li>
                <li>
                    <a class="text-muted" href="{{ route('nosotros') }}">Acerca de nosotros</a>
                </li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5 class="text-primary">Refugios</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="https://www.facebook.com/groups/228942774142526/">Mascotas perdidas Santa Cruz</a></li>
                <li><a class="text-muted" href="https://www.facebook.com/veda.bolivia/">Veda- Voluntarios</a></li>
                <li><a class="text-muted" href="https://www.facebook.com/groups/23205197680/">No compreas Adopta!</a></li>
                <li><a class="text-muted" href="https://www.facebook.com/groups/23205197680/">Adopciones Santa cruz Bolivia</a></li>
            </ul>
        </div>
        <div class="col-6 col-md">
            <h5 class="text-primary">Refugios</h5>
            <ul class="list-unstyled text-small">
                <li><a class="text-muted" href="https://www.facebook.com/MiRefugioSC/">MI Refurio</a></li>
                <li><a class="text-muted" href="https://www.facebook.com/refugio.esperanza.bolivia/">Refugio Esperanza</a></li>
                <li><a class="text-muted" href="https://www.facebook.com/AsociacionProtectoraDeAnimalesSantaCruz">A.P.A SCZ</a></li>
                <li><a class="text-muted" href="https://www.facebook.com/MiRefugioSC">Mi refugio</a></li>
            </ul>
        </div>
    </div>
</footer>
