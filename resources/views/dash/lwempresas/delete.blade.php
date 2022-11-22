<div wire:ignore.self class="modal fade" id="modalDelete" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel">Eliminar Empresa</h5>
            </div>
            <div class="modal-body py-4">
                @if($moEmpresa)
                    <p class="text-center mb-0">¿Esta seguro que desea eliminar la empresa?<br><span class="fw-bold">{{ $moEmpresa->razon_social }}</span></p>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" wire:click="close" class="btn btn-secondary mx-0" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" wire:click="destroy" class="btn btn-danger" data-bs-dismiss="modal">Eliminar</button>
            </div>
        </div>
    </div>
</div>