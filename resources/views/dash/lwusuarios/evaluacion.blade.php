<div wire:ignore.self class="modal fade" id="modalEvaluacion" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalEvaluacionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEvaluacionLabel">Examen realizado por el alumno</h5>
            </div>
            <div class="modal-body">

                @if($moUsuario && $moEvaluacion)

                    <div class="alert alert-primary small px-2 py-1" role="alert">
                        <i class="bi bi-info-circle-fill me-1"></i> Las respuestas del alumno se resaltan en <span class="text-primary fw-bold">indigo</span> y las que estan en <span class="text-danger fw-bold">rojo</span> no fueron contestadas
                    </div>
                
                    <ul style="list-style-type:number">
                        @foreach($moEvaluacion->examen->preguntas->sortBy('orden') as $pregunta)
                            <li>
                                <span class="fw-bold">{{ $pregunta->descripcion }}</span>
                                <ul style="list-style-type:upper-alpha">
                                    @foreach($pregunta->opciones->sortBy('orden') as $opcion)
                                        <li class="my-2">
                                            @if($moEvaluacion->respuestas->where('pregunta_id', $pregunta->id)->count())
                                                @if($moEvaluacion->respuestas->where('pregunta_id', $pregunta->id)->where('opcion_id', $opcion->id)->count())
                                                    @if($opcion->tipo == 'T')
                                                        <span class="text-primary fw-bold">{{ $opcion->descripcion }}</span>
                                                    @else
                                                        <img src="{{ Storage::url($opcion->descripcion) }}" class="img-fluid rounded border border-primary border-5" width="50" alt="Imagen">
                                                    @endif
                                                @else
                                                    @if($opcion->tipo == 'T')
                                                        {{ $opcion->descripcion }}
                                                    @else
                                                        <img src="{{ Storage::url($opcion->descripcion) }}" class="img-fluid rounded" width="50" alt="Imagen">
                                                    @endif
                                                @endif
                                            @else
                                                @if($opcion->tipo == 'T')
                                                    <span class="text-danger">{{ $opcion->descripcion }}</span>
                                                @else
                                                    <img src="{{ Storage::url($opcion->descripcion) }}" class="img-fluid rounded border border-danger border-5" width="50" alt="Imagen">
                                                @endif
                                            @endif
                                        </li>
                                    @endforeach
                                </ul>
                            </li>
                        @endforeach
                    </ul>

                @endif

            </div>
            <div class="modal-footer">
                <button type="button" wire:click="closeEvaluacion" class="btn btn-secondary mx-0" data-bs-toggle="modal" data-bs-target="#modalEvaluaciones">Volver</button>
            </div>
        </div>
    </div>
</div>