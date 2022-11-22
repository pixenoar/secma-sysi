@if(session('rol')->id == 4)
    <div class="container-fluid d-flex justify-content-center align-items-center bg-primary shadow-sm px-4 py-2">
        <div>
            <ul class="nav justify-content-center">
                <li class="nav-item">
                    <a class="nav-link {{ Str::contains(url()->current(), 'cursos') ? 'link-info fw-bold' : 'link-light' }}" href="{{ route('alumno.cursos.index') }}"><i class="bi bi-journals me-1"></i> Cursos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Str::contains(url()->current(), 'examenes') ? 'link-info fw-bold' : 'link-light' }}" href="{{ route('alumno.examenes.index') }}"><i class="bi bi-ui-checks me-1"></i> Examenes</a>
                </li>
            </ul>
        </div>
    </div>
@endif