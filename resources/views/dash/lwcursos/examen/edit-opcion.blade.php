<div wire:ignore.self class="modal fade" id="modalEditOpcion" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalEditOpcionLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalEditOpcionLabel">Modificar opción</h5>
            </div>
            <form wire:submit.prevent="opcUpdate">
                <div class="modal-body py-4">
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
                                    <input type="text" class="form-control @error('opcDescripcion') is-invalid @enderror" id="opcDescripcion" wire:model.defer="opcDescripcion" placeholder="Descripción">
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
                                    <div class="row align-items-end g-3">
                                        <div class="col-lg-2">
                                            @if($moOpcion)
                                                <img src="{{ Storage::url($moOpcion->descripcion) }}" class="img-fluid rounded" alt="Imagen">
                                            @endif
                                        </div>
                                        <div class="col-lg-10">
                                            <label for="opcDiapositiva" class="form-label">Adjuntar archivo</label>
                                            <input class="form-control @error('opcDiapositiva') is-invalid @enderror" type="file" wire:model="opcDiapositiva" id="opcDiapositiva">
                                            @error('opcDiapositiva')
                                                <span class="invalid-feedback">
                                                    {{ $message }}
                                                </span>
                                            @enderror                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-lg-12">
                            <input type="checkbox" class="btn-check" id="opcCorrecta" wire:model="opcCorrecta" autocomplete="off">
                            <label class="btn btn-outline-success btn-sm" for="opcCorrecta"><i class="bi bi-check-lg"></i> ESTA OPCIÓN ES CORRECTA</label>  
                        </div>
                    </div>
                </div>
                <div class="modal-footer @if(session()->has('message')) border-top border-success border-3 @endif">
                    <button type="button" wire:click="opcClose" class="btn btn-secondary mx-0" data-bs-toggle="modal" data-bs-target="#modalExamen">Volver</button>
                    <button type="submit" class="btn btn-primary" wire:target="opcUpdate" wire:loading.class="disabled">
                        <div wire:loading.remove wire:target="opcUpdate">Guardar</div>                        
                        <div wire:loading wire:target="opcUpdate">Guardando...</div>
                    </button>
                </div>
            </form> 
        </div>
    </div>
</div>