<div wire:ignore.self class="modal fade" id="modalMateriales" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalMaterialesLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalMaterialesLabel">Materiales del curso</h5>
            </div>
            <div class="modal-body py-4">

                <form wire:submit.prevent="matStore">

                    <div class="row g-3">
                        <div class="col-lg-4">
                            <div class="form-floating">
                                <select class="form-select" id="matTipo" wire:model="matTipo" aria-label="Tipo">
                                    <option value="A">Archivo</option>
                                    <option value="U">URL</option>
                                </select>
                                <label for="matTipo">Tipo</label>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('matNombre') is-invalid @enderror" wire:model.defer="matNombre" id="matNombre" placeholder="Nombre">
                                <label for="matNombre">Nombre</label>
                                @error('matNombre')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>            
                        @if($matTipo=='A')
                            <div class="col-12">
                                <div class="border rounded p-3">
                                    <label for="matArchivo" class="form-label">Adjuntar archivo</label>
                                    <input class="form-control @error('matArchivo') is-invalid @enderror" type="file" wire:model.defer="matArchivo" id="matArchivo">
                                    @error('matArchivo')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror  
                                </div>                  
                            </div>
                        @else
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('matUrl') is-invalid @enderror" wire:model.defer="matUrl" id="matUrl" placeholder="URL">
                                    <label for="matUrl">URL</label>
                                    @error('matUrl')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" wire:target="matStore" wire:loading.class="disabled">
                        <div wire:loading.remove wire:target="matStore">Guardar</div>                        
                        <div wire:loading wire:target="matStore">Guardando...</div>
                    </button>

                </form>

                <div class="card mt-4">
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
                                    @if($moCurso)
                                        @forelse($moCurso->materiales as $material)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td><a href="@if($material->tipo=='A') {{ Storage::url($material->url) }} @else {{ $material->url }} @endif" target="_blank" class="text-decoration-none">{{ $material->nombre }}</a></td>
                                                <td>
                                                    <button type="button" wire:click="matDelete({{ $material->id }})" class="btn btn-danger btn-sm" title="Eliminar"><i class="bi bi-trash"></i></button>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">No se encontraron materiales</td>
                                            </tr>
                                        @endforelse
                                    @endif
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>           

            </div>
            <div class="modal-footer @if(session()->has('message')) border-top border-success border-3 @endif">
                <button type="button" wire:click="matClose" class="btn btn-secondary mx-0" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>