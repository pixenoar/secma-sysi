<div wire:ignore.self class="modal fade" id="modalEditSector" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalEditSectorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalEditSectorLabel">Modificar sector</h5>
            </div>
            <form wire:submit.prevent="updateSector">
                <div class="modal-body py-4">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('seNombre') is-invalid @enderror" id="seNombre" wire:model.defer="seNombre" placeholder="Nombre">
                                <label for="seNombre">Nombre</label>
                                @error('seNombre')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>
                 
                </div>
                <div class="modal-footer @if(session()->has('message')) border-top border-success border-3 @endif">
                    <button type="button" wire:click="close" class="btn btn-secondary mx-0" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" wire:target="updateSector" wire:loading.class="disabled">
                        <div wire:loading.remove wire:target="updateSector">
                            Guardar
                        </div>                        
                        <div wire:loading wire:target="updateSector">
                            Guardando...
                        </div>
                    </button>
                </div>
            </form> 
        </div>
    </div>
</div>