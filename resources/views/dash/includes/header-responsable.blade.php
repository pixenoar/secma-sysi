
<div class="container-fluid d-flex justify-content-evenly align-items-center bg-primary shadow-sm px-4 py-2">
    <div>
        <h5 class="text-white fw-bold mb-0"><i class="bi bi-building me-1"></i> {{ $moEmpresa->razon_social }}</h5>
    </div>

    <div class="d-none d-lg-block">
        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link {{ request()->routeIs('empresas.dashboard.index') ? 'link-info fw-bold' : 'link-light' }}" href="{{ route('empresas.dashboard.index', $moEmpresa) }}"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a>
            </li>
            <li class="nav-item">
                <a class="nav-link {{ Str::contains(url()->current(), 'usuarios') ? 'link-info fw-bold' : 'link-light' }}" href="{{ route('empresas.usuarios.index', $moEmpresa) }}"><i class="bi bi-people me-1"></i> Usuarios</a>
            </li>
        </ul>
    </div>
    <div class="d-lg-none">
        <a href="#" class="link-light" role="button" id="empresa" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10"><i class="bi bi-three-dots-vertical bi-1x"></i></a>
        <ul class="dropdown-menu" aria-labelledby="empresa">
            <li><a class="dropdown-item small @if(request()->routeIs('empresas.dashboard.index')) active @endif" href="{{ route('empresas.dashboard.index', $moEmpresa) }}"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a></li>
            <li><a class="dropdown-item small @if(Str::contains(url()->current(), 'usuarios')) active @endif" href="{{ route('empresas.usuarios.index', $moEmpresa) }}"><i class="bi bi-people me-1"></i> Usuarios</a></li>
        </ul>
    </div>
</div>
