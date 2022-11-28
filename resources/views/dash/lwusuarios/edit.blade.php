<div wire:ignore.self class="modal fade" id="modalEdit" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Modificar Usuario</h5>
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
                                <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" wire:model.defer="name" placeholder="Nombre" @if($clon) disabled @endif>
                                <label for="name">Nombre</label>
                                @error('name')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" wire:model.defer="surname" placeholder="Apellido" @if($clon) disabled @endif>
                                <label for="surname">Apellido</label>
                                @error('surname')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('dni') is-invalid @enderror" id="dni" wire:model="dni" placeholder="DNI" @if($clon) disabled @endif>
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
                                <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" wire:model.defer="email" placeholder="Correo Electrónico">
                                <label for="email">Correo Electrónico</label>
                                @error('email')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-select" data-bs-toggle="modal" data-bs-target="#modalOrganigrama">
                                <span class="text-muted fw-light small d-block">Sector</span>
                                <span class="pb-1 d-block">@if($moSector) {{ $moSector->nombre }} @else Seleccionar @endif</span>
                            </div>
                            @error('moSector')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                        </div>
                        <div class="col-lg-6">
                            <div class="form-floating">
                                <select class="form-select @error('puesto') is-invalid @enderror" id="puesto" wire:model.defer="puesto" aria-label="Puesto">
                                    <option value="" selected>Seleccionar</option>
                                    @if($moSector)
                                        @foreach($moSector->puestos as $puesto)
                                        <option value="{{ $puesto->id }}">{{ $puesto->nombre }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <label for="puesto">Puesto</label>
                                @error('puesto')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <h5 class="mt-3 mb-0">Roles</h5>
                            <p class="text-muted small mb-0">Seleccionar uno o más roles</p>
                        </div>
                        <div class="col-lg-12">
                            @foreach($moRoles as $rol)
                                <div class="d-inline-block mb-1">
                                    <input type="checkbox" class="btn-check" id="roles{{ $loop->iteration }}" wire:model="roles" value="{{ $rol->id }}" autocomplete="off">
                                    <label class="btn btn-outline-primary btn-sm" for="roles{{ $loop->iteration }}">{{ $rol->nombre }}</label><br>
                                </div>
                            @endforeach
                            @error('roles')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
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