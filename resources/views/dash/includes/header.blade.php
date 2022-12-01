<div class="container-fluid d-flex justify-content-between align-items-center bg-white shadow-sm px-4 py-3">
    <div>
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('img/logo-dash.svg') }}" alt="Logo" class="img-fluid">
        </a>
        
    </div>
    @if(session('rol')->id == 1)
        <div class="d-none d-lg-block">
            <ul class="nav nav-pills">
                <li class="nav-item">
                    <a href="{{ route('dashboard') }}" class="nav-link @if(request()->routeIs('dashboard')) active @endif"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('empresas.index') }}" class="nav-link @if(request()->routeIs('empresas.*')) active @endif"><i class="bi bi-building me-1"></i> Empresas</a>
                </li>
            </ul>
        </div>
    @endif
    <div>
        <ul class="nav">
            @if(session('rol')->id == 1)
                <li class="nav-item dropdown d-lg-none">
                    <a href="#" class="nav-link" id="admin" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="-10,5"><i class="bi bi-three-dots-vertical bi-1x"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="admin">
                        <li><a href="{{ route('dashboard') }}" class="dropdown-item small @if(request()->routeIs('dashboard')) active @endif"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a></li>
                        <li><a href="{{ route('empresas.index') }}" class="dropdown-item small @if(request()->routeIs('empresas.*')) active @endif"><i class="bi bi-building me-1"></i> Empresas</a></li>
                    </ul>
                </li>
            @endif
            <li class="nav-item dropdown">
                <a href="#" class="nav-link" id="acount" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="-10,5"><i class="bi bi-person-circle bi-1x"></i></a>
                <ul class="dropdown-menu" aria-labelledby="acount">
                    <li><h6 class="dropdown-header fw-bold">{{ Auth::user()->name.' '.Auth::user()->surname }}</h6></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><h6 class="dropdown-header text-primary fw-bold">Empresas</h6></li>
                    @forelse(Auth::user()->empresas->where('estado', 1)->sortBy('razon_social') as $empresax)
                        <li><a href="{{ route('change.empresa', $empresax) }}" class="dropdown-item small">{{ $empresax->razon_social }}  @if($empresax->id == session('empresa')->id)<i class="bi bi-check"></i>@endif</a></li>
                    @endforeach
                    <li><hr class="dropdown-divider"></li>
                    <li><h6 class="dropdown-header text-primary fw-bold">Roles</h6></li>
                    @forelse(Auth::user()->roles()->wherePivot('empresa_id', session('empresa')->id)->orderBy('id')->get() as $rol)
                        <li><a href="{{ route('change.rol', $rol) }}" class="dropdown-item small">{{ $rol->nombre }} @if($rol->id == session('rol')->id)<i class="bi bi-check"></i>@endif</a></li>
                    @endforeach
                    <li><hr class="dropdown-divider"></li>
                    <li><a href="{{ route('micuenta') }}" class="dropdown-item small">Mi Cuenta</a></li>
                    <li><a href="javascript:void(0)" class="dropdown-item small" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a></li>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                </ul>
            </li>
        </ul>
    </div>
</div>