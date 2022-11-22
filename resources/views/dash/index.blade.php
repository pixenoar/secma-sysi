@extends('dash.main')

@section('title')
    Dashboard -
@endsection


@section('contenido')

    <div>
        <!-- header principal -->
        <div class="container-fluid d-flex justify-content-between align-items-center bg-white shadow-sm px-4 py-3">
            <div>
                <img src="{{ asset('img/logo-dash.svg') }}" alt="Logo" class="img-fluid">
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
                    <li class="nav-item">
                        <a href="#" class="nav-link"><i class="bi bi-bell bi-1x"></i></a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link" id="acount" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="-10,5"><i class="bi bi-person-circle bi-1x"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="acount">
                            <li><h6 class="dropdown-header fw-bold">{{ Auth::user()->name.' '.Auth::user()->surname }}</h6></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><h6 class="dropdown-header text-primary fw-bold">Empresas</h6></li>
                            @forelse(Auth::user()->empresas->sortBy('razon_social') as $empresax)
                                <li><a href="{{ route('change.empresa', $empresax) }}" class="dropdown-item small">{{ $empresax->razon_social }}  @if($empresax->id == session('empresa')->id)<i class="bi bi-check"></i>@endif</a></li>
                            @endforeach
                            <li><hr class="dropdown-divider"></li>
                            <li><h6 class="dropdown-header text-primary fw-bold">Roles</h6></li>
                            @forelse(Auth::user()->roles()->wherePivot('empresa_id', session('empresa')->id)->orderBy('id')->get() as $rol)
                                <li><a href="{{ route('change.rol', $rol) }}" class="dropdown-item small">{{ $rol->nombre }} @if($rol->id == session('rol')->id)<i class="bi bi-check"></i>@endif</a></li>
                            @endforeach
                            <li><hr class="dropdown-divider"></li>
                            <li><a href="#" class="dropdown-item small">Mi Cuenta</a></li>
                            <li><a href="javascript:void(0)" class="dropdown-item small" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Cerrar Sesión</a></li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">@csrf</form>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
        <!-- header de empresa -->
        @if(isset($empresa))
            <div class="container-fluid d-flex justify-content-evenly align-items-center bg-primary shadow-sm px-4 py-2">
                    <div>
                        <h5 class="text-white fw-bold mb-0"><i class="bi bi-building me-1"></i> @yield('empresa')</h5>
                    </div>
                    <div class="d-none d-lg-block">
                        <ul class="nav justify-content-center">
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('empresas.dashboard.index') ? 'link-info fw-bold' : 'link-light' }}" href="{{ route('empresas.dashboard.index', $empresa) }}"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('empresas.organigrama.index') ? 'link-info fw-bold' : 'link-light' }}" href="{{ route('empresas.organigrama.index', $empresa) }}"><i class="bi bi-diagram-3 me-1"></i> Organigrama</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('empresas.usuarios.index') ? 'link-info fw-bold' : 'link-light' }}" href="{{ route('empresas.usuarios.index', $empresa) }}"><i class="bi bi-people me-1"></i> Usuarios</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('empresas.profesores.index') ? 'link-info fw-bold' : 'link-light' }}" href="{{ route('empresas.profesores.index', $empresa) }}"><i class="bi bi-person-workspace me-1"></i> Profesores</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('empresas.cursos.index') ? 'link-info fw-bold' : 'link-light' }}" href="{{ route('empresas.cursos.index', $empresa) }}"><i class="bi bi-journals me-1"></i> Cursos</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('empresas.planes.index') ? 'link-info fw-bold' : 'link-light' }}" href="{{ route('empresas.planes.index', $empresa) }}"><i class="bi bi-calendar-check me-1"></i> Planes</a>
                            </li>
                        </ul>
                    </div>
                    <div class="d-lg-none">
                        <a href="#" class="link-light" role="button" id="empresa" data-bs-toggle="dropdown" aria-expanded="false" data-bs-offset="0,10"><i class="bi bi-three-dots-vertical bi-1x"></i></a>
                        <ul class="dropdown-menu" aria-labelledby="empresa">
                            <li><a class="dropdown-item small @if(request()->routeIs('empresas.dashboard.index')) active @endif" href="{{ route('empresas.dashboard.index', $empresa) }}"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a></li>
                            <li><a class="dropdown-item small @if(request()->routeIs('empresas.organigrama.index')) active @endif" href="{{ route('empresas.organigrama.index', $empresa) }}"><i class="bi bi-diagram-3 me-1"></i> Organigrama</a></li>
                            <li><a class="dropdown-item small @if(request()->routeIs('empresas.usuarios.index')) active @endif" href="{{ route('empresas.usuarios.index', $empresa) }}"><i class="bi bi-people me-1"></i> Usuarios</a></li>
                            <li><a class="dropdown-item small @if(request()->routeIs('empresas.profesores.index')) active @endif" href="{{ route('empresas.profesores.index', $empresa) }}"><i class="bi bi-person-workspace me-1"></i> Profesores</a></li>
                            <li><a class="dropdown-item small @if(request()->routeIs('empresas.cursos.index')) active @endif" href="{{ route('empresas.cursos.index', $empresa) }}"><i class="bi bi-journals me-1"></i> Cursos</a></li>
                            <li><a class="dropdown-item small @if(request()->routeIs('empresas.planes.index')) active @endif" href="{{ route('empresas.planes.index', $empresa) }}"><i class="bi bi-calendar-check me-1"></i> Planes</a></li>
                        </ul>
                    </div>
            </div>
        @endif

        @if(session('rol')->id == 4)
            <div class="container-fluid d-flex justify-content-center align-items-center bg-primary shadow-sm px-4 py-2">
                <div>
                    <ul class="nav justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('alumno.index') ? 'link-info fw-bold' : 'link-light' }}" href="{{ route('alumno.index') }}"><i class="bi bi-journals me-1"></i> Cursos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link {{ request()->routeIs('alumno.examenes') ? 'link-info fw-bold' : 'link-light' }}" href="{{ route('alumno.examenes') }}"><i class="bi bi-ui-checks me-1"></i> Examenes</a>
                        </li>
                    </ul>
                </div>
            </div>
        @endif
        <!-- Contenido -->
        <div class="p-4 p-lg-5">
           {{ $main }}
        </div>
    </div>

@endsection