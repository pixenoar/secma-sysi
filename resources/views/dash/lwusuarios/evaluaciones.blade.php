<div wire:ignore.self class="modal fade" id="modalEvaluaciones" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalEvaluacionesLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEvaluacionesLabel">Examenes</h5>
            </div>
            <div class="modal-body">

                @if($moUsuario)
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Curso</th>
                                    <th scope="col">Fecha</th>
                                    <th scope="col">Calificación</th>
                                    <th scope="col">Nota</th>
                                    <th scope="col">Válido hasta</th>
                                    <th scope="col">Observaciones</th>
                                    <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($moEvaluaciones as $evaluacion)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>{{ $evaluacion->examen->curso->nombre }}</td>
                                        <td>{{ $evaluacion->updated_at->format('d/m/Y') }}</td>
                                        <td>{{ $evaluacion->calificacion() }}</td>
                                        <td>
                                            @if($evaluacion->estado == 'C')
                                                @if($evaluacion->nota == 'A')
                                                    <span class="badge bg-success">APROBADO</span>
                                                @else
                                                    <span class="badge bg-danger">DESAPROBADO</span>
                                                @endif
                                            @endif
                                        </td>
                                        <td>{{ $evaluacion->vigencia() }}</td>
                                        <td>
                                            @if($evaluacion->estado == 'I')
                                                <span class="badge bg-warning">INCOMPLETO</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('certificado',  $evaluacion) }}" class="btn btn-primary btn-sm @if ($evaluacion->nota <> 'A') disabled @endif" role="button" title="Descargar certificado"><i class="bi bi-download"></i></a>
                                            <button type="button" wire:click="evaluacion({{ $evaluacion->id }})" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEvaluacion" title="Ver examen"><i class="bi bi-eye"></i></button>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">No se encontraron examenes</td>
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