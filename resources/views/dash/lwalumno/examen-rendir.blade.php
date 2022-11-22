<div wire:ignore.self class="modal fade" id="modalExamenRendir" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalExamenRendirLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            @if($reMoExamen)
                <div class="modal-header">
                    <h5 class="modal-title" id="modalCursoRendirLabel">Examen de <span class="fw-bold">{{ $reMoExamen->curso->nombre }}</span></h5>
                </div>
                <div class="modal-body p-4 p-lg-5">
                    
                    @if($reMoPreguntas->count())

                        <div class="progress">
                            <div class="progress-bar progress-bar-striped" role="progressbar" style="width: {{ $reProgreso }}%" aria-valuenow="{{ $reProgreso }}" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <h6 class="text-center mt-2">PREGUNTA <span class="fw-bold">{{ $reContadorPregunta }} / {{ $reMoExamen->preguntas->count() }}</span></h6>
                        <div class="my-5">
                            <h5 class="text-center fw-bold">{{ $reMoPreguntas->first()->descripcion }}</h5>
                            <p class="text-center text-muted small"><i class="bi bi-check2-square"></i> Selecciona la(s) opciones correctas</p>                            
                        </div>

                    
                        @foreach($reMoPreguntas->first()->opciones as $opcion)
                            @if($loop->first)
                                <div class="row justify-content-center gx-4 gx-lg-5 gy-4">
                            @endif

                                @if($opcion->tipo == 'T')
                                    <div class="col-2 col-lg-1">
                                        <input type="checkbox" class="btn-check" id="op{{ $loop->iteration }}" wire:model="reRespuestas" value="{{ $opcion->id }}" autocomplete="off">
                                        <label class="btn btn-outline-success btn-sm" for="op{{ $loop->iteration }}"><i class="bi bi-check-lg"></i></label> 
                                    </div>                 
                                    <div class="col-10 col-lg-11">{{ $opcion->descripcion }}</div>
                                @else
                                    <div class="col-2 col-lg-1">
                                        <input type="checkbox" class="btn-check" id="op{{ $loop->iteration }}" wire:model="reRespuestas" value="{{ $opcion->id }}" autocomplete="off">
                                        <label class="btn btn-outline-success btn-sm" for="op{{ $loop->iteration }}"><i class="bi bi-check-lg"></i></label> 
                                    </div> 
                                    <div class="col-4 col-lg-3">
                                        <div class="position-relative">
                                            <img src="{{ Storage::url($opcion->descripcion) }}" class="img-fluid rounded" alt="Imagen">
                                            <div class="position-absolute bottom-0 end-0 p-1 p-lg-2">
                                                <a href="{{ Storage::url($opcion->descripcion) }}" target="_blank" class="btn btn-light btn-sm" role="button"><i class="bi bi-arrows-fullscreen"></i></a>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                            @if($loop->last)
                                </div>
                            @endif

                        @endforeach
                       
                        
                    @else
                        <div class="text-center">
                            @if($reEvaluacion->nota == 'A')
                                <h1><span class="badge bg-success">{{ $reEvaluacion->calificacion }} %</span></h1>
                                <h2 class="fw-bold text-success">EXAMEN APROBADO</h2>
                                <p><span class="fw-bold">¡Felicitaciones {{ Auth::user()->name }}!</span> has aprobado el curso</p>
                                <a href="{{ route('certificado', $reEvaluacion) }}" class="btn btn-primary mt-4" role="button">Descargar Certificado <i class="bi bi-download ms-1"></i></a>
                            @else
                                <h1><span class="badge bg-danger">{{ $reEvaluacion->calificacion }} %</span></h1>
                                <h2 class="fw-bold text-danger">EXAMEN DESAPROBADO</h2>
                                @if($reEvaluacion->calificacion >= $reMoExamen->porcentaje_aprobacion)
                                    <p>Aunque alcanzaste el porcentaje de aprobación, el examen fue desaprobado por <span class="fw-bold">haber contestado mal una pregunta excluyente</span>.</p>
                                @else
                                    <p>El examen fue desaprobado porque <span class="fw-bold">no alcanzaste el porcentaje de aprobación</span>.</p>
                                @endif
                            @endif
                        </div>
                    @endif
                </div>
                <div class="modal-footer">
                    @if($reMoPreguntas->count())
                        <button type="button" class="btn @if($reTiempo>30) btn-warning @else btn-danger @endif fw-bold w-25">
                            <div wire:poll.keep-alive.1000ms="cuentaRegresiva">
                                <i class="bi bi-stopwatch"></i> {{ $reCronometro->format('i:s') }}
                            </div>
                        </button>
                        <button type="button" wire:click="responder" class="btn btn-success text-white fw-bold">Siguiente <i class="bi bi-arrow-right"></i></button>
                    @else
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>