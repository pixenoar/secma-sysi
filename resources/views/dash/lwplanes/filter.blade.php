<div wire:ignore.self class="modal fade" id="modalFilter" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalFilterLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalFilterLabel"><i class="bi bi-funnel-fill"></i> Filtros</h5>
            </div>
            <form wire:submit.prevent="filter">
                <div class="modal-body">

                    <div class="row gy-3">
                        <div class="col-lg-12">
                            <div class="form-select" data-bs-toggle="modal" data-bs-target="#modalOrganigrama">
                                <span class="text-muted fw-light small d-block">Sector</span>
                                <span class="pb-1 d-block">@if($moSector) {{ $moSector->nombre }} @else Seleccionar @endif</span>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <select class="form-select" id="fiPuesto" wire:model="fiPuesto">
                                    <option value="" selected>Seleccionar</option>
                                    @if($moSector)
                                        @foreach($moSector->puestos as $puesto)
                                            <option value="{{ $puesto->id }}">{{ $puesto->nombre }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                <label for="fiPuesto">Puesto</label>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <select class="form-select" id="fiCurso" wire:model="fiCurso">
                                    <option value="" selected>Seleccionar</option>
                                    @foreach($moCursos as $curso)
                                        <option value="{{ $curso->id }}">{{ $curso->nombre }}</option>
                                    @endforeach
                                </select>
                                <label for="fiCurso">Curso</label>
                            </div> 
                        </div>
                    </div> 

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary mx-0" data-bs-dismiss="modal">Cerrar</button>
                    <button type="button" wire:click="limpiarFiltros" wire:loading.class="disabled" class="btn btn-danger">
                        <div wire:loading.remove wire:target="limpiarFiltros">
                            Limpiar
                        </div>                        
                        <div wire:loading wire:target="limpiarFiltros">
                            Limpiando...
                        </div>
                    </button>
                </div>
            </form> 
        </div>
    </div>
</div>