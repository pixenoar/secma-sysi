<div wire:ignore.self class="modal fade" id="modalCreateOpcion" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalCreateOpcionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateOpcionLabel">Nueva Opción</h5>
            </div>
            <form wire:submit.prevent="opcStore">
                <div class="modal-body position-relative py-4">
                    @if(session()->has('message'))
                        <div class="position-absolute top-100 start-50 translate-middle bg-white">
                            <i class="bi bi-check-circle-fill fs-3 text-success"></i>
                        </div>  
                    @endif
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <select class="form-select" id="opcTipo" wire:model="opcTipo" aria-label="Tipo">
                                    <option value="T">Texto</option>
                                    <option value="D">Diapositiva</option>
                                </select>
                                <label for="opcTipo">Tipo</label>
                            </div>
                        </div>
                        @if($opcTipo=='T')
                            <div class="col-lg-12">
                                <div class="form-floating">
                                    <input type="text" id="opcDescripcion" wire:model.defer="opcDescripcion" class="form-control @error('opcDescripcion') is-invalid @enderror" placeholder="Descripción">
                                    <label for="opcDescripcion">Descripción</label>
                                    @error('opcDescripcion')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @else
                            <div class="col-lg-12">
                                <div class="border rounded p-3">
                                    <label for="opcDiapositiva" class="form-label">Adjuntar archivo</label>
                                    <input type="file" id="opcDiapositiva" wire:model.defer="opcDiapositiva" class="form-control @error('opcDiapositiva') is-invalid @enderror">
                                    @error('opcDiapositiva')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div> 
                            </div>                                       
                        @endif
                        <div class="col-lg-12">
                            <input type="checkbox" class="btn-check" id="opcCorrecta" wire:model="opcCorrecta" autocomplete="off">
                            <label class="btn btn-outline-success btn-sm" for="opcCorrecta"><i class="bi bi-check-lg"></i> ESTA OPCIÓN ES CORRECTA</label>  
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="opcClose" class="btn btn-secondary mx-0" data-bs-toggle="modal" data-bs-target="#modalExamen">Volver</button>
                    <button type="submit" class="btn btn-primary" wire:target="opcStore" wire:loading.class="disabled">
                        <div wire:loading.remove wire:target="opcStore">Guardar</div>                        
                        <div wire:loading wire:target="opcStore">Guardando...</div>
                    </button>
                </div>
            </form> 
        </div>
    </div>
</div>