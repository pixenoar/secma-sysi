<div wire:ignore.self class="modal fade" id="modalEditPuesto" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalEditPuestoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditPuestoLabel">Modificar Puesto</h5>
            </div>
            <form wire:submit.prevent="updatePuesto">
                <div class="modal-body position-relative py-4">
                    @if(session()->has('message'))
                        <div class="position-absolute top-100 start-50 translate-middle bg-white">
                            <i class="bi bi-check-circle-fill fs-3 text-success"></i>
                        </div>  
                    @endif
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('puNombre') is-invalid @enderror" id="puNombre" wire:model.defer="puNombre" placeholder="Nombre">
                                <label for="puNombre">Nombre</label>
                                @error('puNombre')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                 
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="volver" class="btn btn-secondary mx-0" data-bs-toggle="modal" data-bs-target="#modalPuestos">Volver</button>
                    <button type="submit" class="btn btn-primary" wire:target="updatePuesto" wire:loading.class="disabled">
                        <div wire:loading.remove wire:target="updatePuesto">
                            Guardar
                        </div>                        
                        <div wire:loading wire:target="updatePuesto">
                            Guardando...
                        </div>
                    </button>
                </div>
            </form> 
        </div>
    </div>
</div>