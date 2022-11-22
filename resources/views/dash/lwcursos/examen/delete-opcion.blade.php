<div wire:ignore.self class="modal fade" id="modalDeleteOpcion" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalDeleteOpcionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteOpcionLabel">Eliminar Opción</h5>
            </div>
            <div class="modal-body">
                @if($moOpcion)
                    @if($moOpcion->tipo == 'T')
                        <p class="text-center mb-0">¿Esta seguro que desea eliminar la opción?<br><span class="fw-bold">{{ $moOpcion->descripcion }}</span></p>
                    @else
                        <p class="text-center mb-0">
                            ¿Esta seguro que desea eliminar la opción?<br>
                            <img src="{{ Storage::url($moOpcion->descripcion) }}" class="img-fluid rounded w-25 mt-3" alt="Imagen">
                        </p>
                    @endif
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mx-0" data-bs-toggle="modal" data-bs-target="#modalExamen">Cancelar</button>
                <button type="button" wire:click="opcDestroy" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modalExamen">Eliminar</button>
            </div>
        </div>
    </div>
</div>