<div wire:ignore.self class="modal fade" id="modalDelete" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalDeleteLabel">Eliminar Profesor</h5>
            </div>
            <div class="modal-body">

                @if($moProfesor)
                    <p class="text-center mb-0">¿Esta seguro que desea eliminar el profesor?<br><span class="fw-bold">{{ $moProfesor->nombre.' '.$moProfesor->apellido }}</span></p>
                @endif

            </div>
            <div class="modal-footer">
                <button type="button" wire:click="close" class="btn btn-secondary mx-0" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" wire:click="destroy" class="btn btn-danger" data-bs-dismiss="modal">Eliminar</button>
            </div>
        </div>
    </div>
</div>