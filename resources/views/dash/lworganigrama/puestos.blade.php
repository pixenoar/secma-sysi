<div wire:ignore.self class="modal fade" id="modalPuestos" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalPuestosLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPuestosLabel">Puestos de <span class="fw-bold">@if($moSector) {{ $moSector->nombre }} @endif</span></h5>
                
            </div>
            <div class="modal-body position-relative py-4">
                @if(session()->has('message'))
                    <div class="position-absolute top-100 start-50 translate-middle bg-white">
                        <i class="bi bi-check-circle-fill fs-3 text-success"></i>
                    </div>  
                @endif
                <form wire:submit.prevent="storePuesto">
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('puNombre') is-invalid @enderror" wire:model.defer="puNombre" id="puNombre" placeholder="Nombre">
                                <label for="puNombre">Nombre</label>
                                @error('puNombre')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>            
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" wire:target="storePuesto" wire:loading.class="disabled">
                        <div wire:loading.remove wire:target="storePuesto">
                            Guardar
                        </div>                        
                        <div wire:loading wire:target="storePuesto">
                            Guardando...
                        </div>
                    </button>
                </form>
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($moSector)
                                        @forelse($moSector->puestos->sortBy('nombre') as $puesto)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>{{ $puesto->nombre }}</td>
                                                <td>
                                                    <button type="button" wire:click="editPuesto({{ $puesto->id }})" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEditPuesto"><i class="bi bi-pencil"></i></button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No se encontraron puestos</td>
                                            </tr>
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="close" class="btn btn-secondary mx-0" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>