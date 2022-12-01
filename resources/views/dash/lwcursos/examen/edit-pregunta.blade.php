<div wire:ignore.self class="modal fade" id="modalEditPregunta" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalEditPreguntaLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalEditPreguntaLabel">Modificar pregunta</h5>
            </div>
            <form wire:submit.prevent="preUpdate">
                <div class="modal-body py-4">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('preDescripcion') is-invalid @enderror" id="preDescripcion" wire:model.defer="preDescripcion" placeholder="Descripción">
                                <label for="preDescripcion">Descripción</label>
                                @error('preDescripcion')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <input type="checkbox" class="btn-check" id="preExcluyente" wire:model="preExcluyente" autocomplete="off">
                            <label class="btn btn-outline-danger btn-sm" for="preExcluyente"><i class="bi bi-check-lg"></i> ESTA PREGUNTA ES EXCLUYENTE</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer @if(session()->has('message')) border-top border-success border-3 @endif">
                    <button type="button" wire:click="preClose" class="btn btn-secondary mx-0" data-bs-toggle="modal" data-bs-target="#modalExamen">Volver</button>
                    <button type="submit" class="btn btn-primary" wire:target="preUpdate" wire:loading.class="disabled">
                        <div wire:loading.remove wire:target="preUpdate">Guardar</div>                        
                        <div wire:loading wire:target="preUpdate">Guardando...</div>
                    </button>
                </div>
            </form> 
        </div>
    </div>
</div>