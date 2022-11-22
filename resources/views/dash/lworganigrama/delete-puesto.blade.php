<div wire:ignore.self class="modal fade" id="modalDeletePuesto" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalDeletePuestoLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeletePuestoLabel">Eliminar Puesto</h5>
            </div>
            <div class="modal-body">

                @if($moPuesto)
                    <p class="text-center mb-0">¿Esta seguro que desea eliminar el puesto?<br><span class="fw-bold">{{ $moPuesto->nombre }}</span></p>
                @endif

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mx-0" data-bs-toggle="modal" data-bs-target="#modalPuestos">Cancelar</button>
                <button type="button" wire:click="destroyPuesto" class="btn btn-danger" data-bs-dismiss="modal">Eliminar</button>
            </div>
        </div>
    </div>
</div>