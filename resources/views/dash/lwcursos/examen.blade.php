<div wire:ignore.self class="modal fade" id="modalExamen" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalExamenLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalExamenLabel">Examen</h5>
                <span>versión #{{ $moExamen ? $moCurso->version() : '' }}</span>
            </div>
            <div class="modal-body py-4">

                <form wire:submit.prevent="exaUpdate">
                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('exaPorcentajeAprobacion') is-invalid @enderror" wire:model="exaPorcentajeAprobacion" id="exaPorcentajeAprobacion" placeholder="Porcentaje de aprobación">
                                <label for="exaPorcentajeAprobacion">Porcentaje de aprobación</label>
                                @error('exaPorcentajeAprobacion')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('exaTiempoResponder') is-invalid @enderror" wire:model="exaTiempoResponder" id="exaTiempoResponder" placeholder="Tiempo para responder">
                                <label for="exaTiempoResponder">Tiempo para responder (seg.)</label>
                                @error('exaTiempoResponder')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('exaTiempoAnticipacionRendir') is-invalid @enderror" wire:model="exaTiempoAnticipacionRendir" id="exaTiempoAnticipacionRendir" placeholder="Días de anticipación para rendir">
                                <label for="exaTiempoAnticipacionRendir">Días de anticipación para rendir</label>
                                @error('exaTiempoAnticipacionRendir')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-primary" wire:target="ExaUpdate" wire:loading.class="disabled">
                                <div wire:loading.remove wire:target="ExaUpdate">Guardar</div>                        
                                <div wire:loading wire:target="ExaUpdate">Guardando...</div>
                            </button>                            
                        </div>              
                    </div>
                </form>
                
                <div class="card bg-light mt-4">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center mb-5">
                            <div>
                                <h5 class="mb-0 fw-bold text-primary">Preguntas</h5>
                            </div>
                            <div>
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCreatePregunta">Nueva pregunta</button>
                            </div>
                        </div>
                        @if($moExamen)
                            <ul style="list-style-type:number">
                                @forelse($moExamen->preguntas->sortBy('orden') as $pregunta)
                                    <li>
                                        <!-- PREGUNTA #1 -->
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <span class="fw-bold @if($pregunta->excluyente) text-danger @endif">{{ $pregunta->descripcion }}</span>
                                            </div>
                                            <div class="col-lg-4 text-end">
                                                <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                    <button type="button" wire:click="opcCreate({{ $pregunta->id }})" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCreateOpcion">Nueva opción</button>
                                                    <button type="button" wire:click="preUp({{ $pregunta->id }})" class="btn btn-outline-primary @if($loop->first) disabled @endif"><i class="bi bi-chevron-up"></i></button>
                                                    <button type="button" wire:click="preDown({{ $pregunta->id }})" class="btn btn-outline-primary @if($loop->last) disabled @endif"><i class="bi bi-chevron-down"></i></button>
                                                    <button type="button" wire:click="preEdit({{ $pregunta->id }})" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalEditPregunta" title="Modificar"><i class="bi bi-pencil"></i></button>
                                                    <button type="button" wire:click="preDelete({{ $pregunta->id }})" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeletePregunta" title="Eliminar"><i class="bi bi-trash"></i></button>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- OPCIONES -->
                                        <ul style="list-style-type:upper-alpha">
                                            @forelse($pregunta->opciones->sortBy('orden') as $opcion)
                                                <li class="my-2">
                                                    <div class="row">
                                                        <div class="col-lg-8">
                                                            @if($opcion->tipo == 'T')
                                                                <span class="@if($opcion->correcta) fw-bold text-success @endif">{{ $opcion->descripcion }}</span>
                                                            @else
                                                                <img src="{{ Storage::url($opcion->descripcion) }}" class="img-fluid rounded" width="50" alt="Imagen">
                                                                @if($opcion->correcta) <i class="bi bi-check-circle-fill text-success ms-2"></i> @endif    
                                                            @endif
                                                        </div>
                                                        <div class="col-lg-4 text-end">
                                                            <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
                                                                <button type="button" wire:click="opcUp({{ $pregunta->id }}, {{ $opcion->id }})" class="btn btn-outline-primary @if($loop->first) disabled @endif"><i class="bi bi-chevron-up"></i></button>
                                                                <button type="button" wire:click="opcDown({{ $pregunta->id }}, {{ $opcion->id }})" class="btn btn-outline-primary @if($loop->last) disabled @endif"><i class="bi bi-chevron-down"></i></button>
                                                                <button type="button" wire:click="opcEdit({{ $pregunta->id }}, {{ $opcion->id }})" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalEditOpcion"><i class="bi bi-pencil"></i></button>
                                                                <button type="button" wire:click="opcDelete({{ $opcion->id }})" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalDeleteOpcion"><i class="bi bi-trash"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            @empty
                                                <li class="my-2">No hay opciones</li>
                                            @endforelse
                                        </ul>
                                    </li>
                                @empty
                                    <li class="my-2">No hay preguntas</li>
                                @endforelse
                            </ul>    
                        @endif
                    </div>
                </div>

            </div>
            <div class="modal-footer @if(session()->has('message')) border-top border-success border-3 @endif">
                <button type="button" wire:click="exaClose" class="btn btn-secondary mx-0" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>