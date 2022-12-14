<div wire:ignore.self class="modal fade" id="modalEdit" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalEditLabel">Modificar profesor</h5>
            </div>
            <form wire:submit.prevent="update">
                <div class="modal-body py-4">
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" wire:model.defer="nombre" placeholder="Nombre">
                                <label for="nombre">Nombre</label>
                                @error('nombre')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('apellido') is-invalid @enderror" id="apellido" wire:model.defer="apellido" placeholder="Apellido">
                                <label for="apellido">Apellido</label>
                                @error('apellido')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('dni') is-invalid @enderror" id="dni" wire:model.defer="dni" placeholder="DNI">
                                <label for="dni">DNI</label>
                                @error('dni')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('telefono') is-invalid @enderror" id="telefono" wire:model.defer="telefono" placeholder="Tel??fono">
                                <label for="telefono">Tel??fono</label>
                                @error('telefono')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.defer="email" placeholder="Correo Electr??nico">
                                <label for="email">Correo Electr??nico</label>
                                @error('email')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('titulo') is-invalid @enderror" id="titulo" wire:model.defer="titulo" placeholder="T??tulo">
                                <label for="titulo">T??tulo</label>
                                @error('titulo')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('matricula') is-invalid @enderror" id="matricula" wire:model.defer="matricula" placeholder="Matr??cula">
                                <label for="matricula">Matr??cula</label>
                                @error('matricula')
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
                                        @if($moProfesor)
                                            <img src="{{ Storage::url($moProfesor->firma) }}" class="img-fluid rounded" alt="Imagen">
                                        @endif
                                    </div>
                                    <div class="col-lg-10">
                                        <label for="firma" class="form-label">Adjuntar firma</label>
                                        <input class="form-control @error('firma') is-invalid @enderror" type="file" wire:model="firma" id="firma">
                                        @error('firma')
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
                <div class="modal-footer @if(session()->has('message')) border-top border-success border-3 @endif">
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