<div wire:ignore.self class="modal fade" id="modalOrganigrama" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalOrganigramaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalOrganigramaLabel">Organigrama</h5>
            </div>
            <div class="modal-body">
                <ul class="m-0">
                    @forelse($moEmpresa->sectores->where('padre_id', 0)->sortBy('nombre') as $sector)
                        @include('dash.lworganigrama.recursivo', $sector)
                    @empty
                        <div class="p-mb-0">No hay sectores creados.</div>
                    @endforelse
                </ul>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mx-0" data-bs-toggle="modal" data-bs-target="#modalCreateSector">Volver</button>
            </div>
        </div>
    </div>
</div>