<div wire:ignore.self class="modal fade" id="modalEdit" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Modificar Empresa</h5>
            </div>
            <form wire:submit.prevent="update">
                <div class="modal-body position-relative py-4">
                    @if(session()->has('message'))
                        <div class="position-absolute top-100 start-50 translate-middle bg-white">
                            <i class="bi bi-check-circle-fill fs-3 text-success"></i>
                        </div>  
                    @endif
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('razon_social') is-invalid @enderror" id="razon_social" wire:model.defer="razon_social" placeholder="Razón Social">
                                <label for="razon_social">Razón Social</label>
                                @error('razon_social')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('cuit') is-invalid @enderror" id="cuit" wire:model.defer="cuit" placeholder="CUIT">
                                <label for="cuit">CUIT</label>
                                @error('cuit')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('direccion') is-invalid @enderror" id="direccion" wire:model.defer="direccion" placeholder="Dirección">
                                <label for="direccion">Dirección</label>
                                @error('direccion')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" wire:model.defer="telefono" placeholder="Teléfono">
                                <label for="telefono">Teléfono</label>
                                @error('telefono')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('cupo_user') is-invalid @enderror" id="cupo_user" wire:model.defer="cupo_user" placeholder="Usuarios Permitidos">
                                <label for="cupo_user">Usuarios Permitidos</label>
                                @error('cupo_user')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('costo_user') is-invalid @enderror" id="costo_user" wire:model.defer="costo_user" placeholder="Costo Usuario">
                                <label for="costo_user">Costo Usuario</label>
                                @error('costo_user')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="border rounded p-3">
                                <div class="row align-items-end g-3">
                                    <div class="col-lg-2">
                                        @if($moEmpresa)
                                            <img src="{{ Storage::url($moEmpresa->logo) }}" class="img-fluid rounded" alt="Imagen">
                                        @endif
                                    </div>
                                    <div class="col-lg-10">
                                        <label for="logo" class="form-label">Adjuntar Logotipo</label>
                                        <input class="form-control @error('logo') is-invalid @enderror" type="file" wire:model="logo" id="logo">
                                        @error('logo')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror                                    
                                    </div>
                                </div>
                            </div>
                        </div>                        
                    </div>
                 
                </div>
                <div class="modal-footer">                  
                    <button type="button" wire:click="close" class="btn btn-secondary mx-0" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" wire:target="update" wire:loading.class="disabled">
                        <div wire:loading.remove wire:target="update">
                            Guardar
                        </div>                        
                        <div wire:loading wire:target="update">
                            Guardando...
                        </div>
                    </button>
                </div>
            </form> 
        </div>
    </div>
</div>