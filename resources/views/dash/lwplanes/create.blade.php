<div wire:ignore.self class="modal fade" id="modalCreate" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalCreateLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCreateLabel">Nuevo Plan</h5>
            </div>
            <form wire:submit.prevent="store">
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
                                @if($cascada)
                                    <div class="alert alert-warning small p-2 mt-3 mb-0" role="alert">
                                        <i class="bi bi-exclamation-circle-fill"></i> Al crear un plan de forma masiva, los planes existentes seran eliminados y creados nuevamente con los valores actuales.
                                    </div>
                                @endif
                            @endif
                            @error('moSector')
                                <span class="invalid-feedback d-block">
                                    {{ $message }}
                                </span>
                            @enderror
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
                                    @foreach($moCursos->where('estado', 1) as $curso)
                                        <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                                    @endforeach
                                </select>
                                <label for="curso">Curso</label>
                                @error('curso')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div> 
                        </div>
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('frecuencia') is-invalid @enderror" id="frecuencia" wire:model="frecuencia" placeholder="Frecuencia">
                                <label for="frecuencia">Frecuencia <span class="text-muted small">(días)</span></label>
                                @error('frecuencia')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                                <div class="form-text">Para aplicar el plan por <span class="fw-bold">ÚNICA VEZ</span> ingrese el número cero <span class="fw-bold">"0"</span></div>                                
                            </div>
                            @if($moPlan)
                                <div class="alert alert-warning small p-2 mt-3 mb-0" role="alert">
                                    <i class="bi bi-exclamation-circle-fill"></i> Este plan ya existe, si queres podes modificar su frecuencia.
                                </div>
                            @endif
                        </div>
                    </div> 

                 
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="close" class="btn btn-secondary mx-0" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" wire:target="store" wire:loading.class="disabled">
                        <div wire:loading.remove wire:target="store">
                            Guardar
                        </div>                        
                        <div wire:loading wire:target="store">
                            Guardando...
                        </div>
                    </button>
                </div>
            </form> 
        </div>
    </div>
</div>