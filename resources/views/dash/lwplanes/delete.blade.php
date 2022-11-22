<div wire:ignore.self class="modal fade" id="modalDelete" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel">Eliminar Plan</h5>
            </div>
            <form wire:submit.prevent="destroy">
                <div class="modal-body position-relative py-4">
                    @if(session()->has('message'))
                        <div class="position-absolute top-100 start-50 translate-middle bg-white">
                            <i class="bi bi-check-circle-fill fs-3 text-success"></i>
                        </div>  
                    @endif
                    <div class="row gy-3">
                        <div class="col-lg-12">
                            <div class="form-select @error('moSector') is-invalid @enderror" data-bs-toggle="modal" data-bs-target="#modalOrganigrama">
                                <span class="text-muted fw-light small d-block">Sector</span>
                                <span class="pb-1 d-block">@if($moSector) {{ $moSector->nombre }} @else Seleccionar @endif</span>
                            </div>
                            @if($moSector)
                                <div class="mt-3">
                                    <input type="checkbox" class="btn-check" id="cascada" wire:model="cascada" autocomplete="off">
                                    <label class="btn btn-outline-primary btn-sm" for="cascada"><i class="bi bi-arrow-90deg-up"></i> Aplicar a los puestos de este sector y todos sus descendientes</label>                                
                                </div>
                            @endif
                            @error('moSector')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
                            @if($cascada)
                                <div class="alert alert-danger small p-2 mt-3 mb-0" role="alert">
                                    <i class="bi bi-exclamation-circle-fill"></i> Se van a eliminar de forma masiva los planes de los puestos del sector y sus descendientes.
                                </div>
                            @endif
                        </div>
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <select class="form-select @error('puesto') is-invalid @enderror" id="puesto" wire:model="puesto" aria-label="Puesto" @if($cascada) disabled @endif>
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
                            <div class="form-floating">
                                <select class="form-select @error('curso') is-invalid @enderror" id="curso" wire:model="curso">
                                    <option value="" selected>Seleccionar</option>
                                    @foreach($moCursos as $curso)
                                        @if($curso->examen->activo)
                                            <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                <label for="curso">Curso</label>
                                @error('curso')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                                @if($moPlan)
                                    <div class="alert alert-danger small p-2 mt-3 mb-0" role="alert">
                                        <i class="bi bi-exclamation-circle-fill"></i> Se va a eliminar el plan para el puesto seleccionado.
                                    </div>
                                @endif
                            </div> 
                        </div>
                    </div> 
                 
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="close" class="btn btn-secondary mx-0" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-danger" wire:target="destroy">Eliminar</button>
                </div>
            </form> 
        </div>
    </div>
</div>