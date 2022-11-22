<div wire:ignore.self class="modal fade" id="modalDeleteSector" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalDeleteSectorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteSectorLabel">Eliminar Sector</h5>
            </div>
            <div class="modal-body">
                @if($moSector)
                    <p class="text-center mb-0">¿Esta seguro que desea eliminar el sector?<br><span class="fw-bold">{{ $moSector->nombre }}</span></p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="close" class="btn btn-secondary mx-0" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" wire:click="destroySector" class="btn btn-danger" data-bs-dismiss="modal">Eliminar</button>
            </div>
        </div>
    </div>
</div>