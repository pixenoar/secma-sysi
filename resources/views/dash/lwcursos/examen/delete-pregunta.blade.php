<div wire:ignore.self class="modal fade" id="modalDeletePregunta" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalDeletePreguntaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalDeletePreguntaLabel">Eliminar pregunta</h5>
            </div>
            <div class="modal-body">
                @if($moPregunta)
                    <p class="text-center mb-0">¿Esta seguro que desea eliminar la pregunta?<br><span class="fw-bold">{{ $moPregunta->descripcion }}</span></p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mx-0" data-bs-toggle="modal" data-bs-target="#modalExamen">Cancelar</button>
                <button type="button" wire:click="preDestroy" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalExamen">Eliminar</button>
            </div>
        </div>
    </div>
</div>