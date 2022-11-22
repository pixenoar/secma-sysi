<div wire:ignore.self class="modal fade" id="modalOrganigrama" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalOrganigramaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalOrganigramaLabel">Organigrama</h5>
            </div>
            <div class="modal-body">
                <ul>
                    @foreach($moEmpresa->sectores->where('padre_id', 0)->sortBy('nombre') as $sector)
                        @include('dash.includes.modales.organigrama-recursivo', $sector)
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-secondary mx-0" data-bs-toggle="modal" data-bs-target="#modalCreate">Volver</button>
                <button type="button" wire:click="close" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>