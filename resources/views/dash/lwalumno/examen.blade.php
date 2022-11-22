<div wire:ignore.self class="modal fade" id="modalExamen" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalExamenLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body p-4 p-lg-5">
                @if($exMoExamen)
                    <h5 class="text-center">Examen de <span class="fw-bold">{{ $exMoExamen->curso->nombre }}</span></h5>
                    <p class="text-center text-muted mb-0">{{ $exMoExamen->curso->descripcion }}</p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger mx-0" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" wire:click="comenzar({{ $exMoExamen }})" class="btn btn-success text-white" data-bs-toggle="modal" data-bs-target="#modalExamenRendir">Comenzar Examen <i class="bi bi-arrow-right"></i></button>
            </div>
        </div>
    </div>
</div>