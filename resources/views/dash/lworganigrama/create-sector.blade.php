<div wire:ignore.self class="modal fade" id="modalCreateSector" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalCreateSectorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalCreateSectorLabel">Nuevo sector</h5>
            </div>
            <form wire:submit.prevent="storeSector">
                <div class="modal-body py-4">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="form-select" data-bs-toggle="modal" data-bs-target="#modalOrganigrama">
                                <span class="text-muted fw-light small d-block">Sector Padre</span>
                                <span class="pb-1 d-block">@if($moSector) {{ $moSector->nombre }} @else Seleccionar sector padre @endif</span>
                            </div>
                        </div>
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
                    <button type="submit" class="btn btn-primary" wire:target="storeSector" wire:loading.class="disabled">
                        <div wire:loading.remove wire:target="storeSector">
                            Guardar
                        </div>                        
                        <div wire:loading wire:target="storeSector">
                            Guardando...
                        </div>
                    </button>
                </div>
            </form> 
        </div>
    </div>
</div>