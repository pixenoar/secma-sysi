<div>

    @include('dash.includes.header-alumno')

    <div class="p-4 p-lg-5">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold mb-0">Cursos Asignados</h5>
            </div>
            <div></div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th scope="col">Curso</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Observaciones</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($moPuesto->planes as $plan)
                                <tr>
                                    <td>{{ $plan->curso->nombre }}</td>
                                    <td>
                                        @if($plan->estado(Auth::user()->id, session('empresa')->id) == 'P')
                                            @if($plan->bloqueado(Auth::user()->id, session('empresa')->id))
                                                <span class="badge bg-secondary">BLOQUEADO</span>
                                            @else
                                                <span class="badge bg-danger">PENDIENTE</span>
                                            @endif
                                        @else
                                            <span class="badge bg-success">VIGENTE</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $plan->estado(Auth::user()->id, session('empresa')->id) == 'V' )
                                            {{ $plan->curso->examen->evaluaciones->where('user_id', Auth::user()->id)->where('nota', 'A')->sortByDesc('id')->first()->vigencia() }}
                                        @elseif( $plan->bloqueado(Auth::user()->id, session('empresa')->id) )
                                            Pongase en contacto con su supervisor.
                                        @endif
                                    </td>
                                    <td>
                                        <button type="button" wire:click="curso({{ $plan->curso }})" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCurso" title="Información del curso"><i class="bi bi-journal"></i></button>                               
                                        <button type="button" wire:click="rendir({{ $plan->curso->examen }})" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalExamen" @if( ($plan->estado(Auth::user()->id, session('empresa')->id) == 'V') || ($plan->bloqueado(Auth::user()->id, session('empresa')->id)) ) disabled @endif title="Rendir examen"><i class="bi-ui-checks"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No se encontraron cursos</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @include('dash.lwalumno.curso')

    @include('dash.lwalumno.examen')

    @include('dash.lwalumno.examen-rendir')

</div>