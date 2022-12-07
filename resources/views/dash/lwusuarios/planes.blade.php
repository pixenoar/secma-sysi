<div wire:ignore.self class="modal fade" id="modalPlanes" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalPlanesLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalPlanesLabel">Plan de capacitación</h5>
            </div>
            <div class="modal-body">
            @if($moPuesto && $moUsuario)
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Curso</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Observaciones</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($moPuesto->planes as $plan)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $plan->curso->nombre }}</td>
                                    <td>
                                        @if($plan->estado($moUsuario->id, $moEmpresa->id) == 'P')
                                            @if($plan->bloqueado($moUsuario->id, $moEmpresa->id))
                                                <span class="badge bg-secondary">BLOQUEADO</span>
                                            @else
                                                <span class="badge bg-danger">PENDIENTE</span>
                                            @endif
                                        @else
                                            <span class="badge bg-success">VIGENTE</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if( $plan->estado($moUsuario->id, $moEmpresa->id) == 'V' )
                                            {{ $plan->curso->examen->evaluaciones->where('user_id', $moUsuario->id)->where('nota', 'A')->sortByDesc('id')->first()->vigencia() }}
                                        @elseif( $plan->bloqueado($moUsuario->id, $moEmpresa->id) )
                                            Curso bloqueado.
                                        @endif
                                    </td>
                                    <td>
                                        @if($plan->bloqueado($moUsuario->id, $moEmpresa->id))
                                            <button type="button" wire:click="desbloquearPlan({{ $plan->id }})" class="btn btn-primary btn-sm" title="Desbloquear cusrso"><i class="bi bi-unlock"></i></button>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No se encontraron cursos</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            @endif
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="close" class="btn btn-secondary mx-0" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>