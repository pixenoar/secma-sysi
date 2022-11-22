<div wire:ignore.self class="modal fade" id="modalShow" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalShowLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShowLabel">Información del usuario</h5>
            </div>
            <div class="modal-body">

                @if($moUsuario && $moPuesto)
                    <dl class="row gy-3 mb-0">
                        <dt class="col-lg-4">Nombre</dt>
                        <dd class="col-lg-8">{{ $moUsuario->name }}</dd>
                        <dt class="col-lg-4">Apellido</dt>
                        <dd class="col-lg-8">{{ $moUsuario->surname }}</dd>
                        <dt class="col-lg-4">DNI</dt>
                        <dd class="col-lg-8">{{ $moUsuario->dni }}</dd>
                        <dt class="col-lg-4">Email</dt>
                        <dd class="col-lg-8">{{ $moUsuario->email }}</dd>
                        <dt class="col-lg-4">Sector</dt>
                        <dd class="col-lg-8">{{ $moPuesto->sector->nombre }}</dd>
                        <dt class="col-lg-4">Puesto</dt>
                        <dd class="col-lg-8">{{ $moPuesto->nombre }}</dd>
                        <dt class="col-lg-4">Roles</dt>
                        <dd class="col-lg-8">
                            @forelse($moUsuario->roles()->wherePivot('empresa_id', $moEmpresa->id)->get() as $rol)
                                {{ $rol->nombre }}<br>
                            @empty
                                No tiene roles
                            @endforelse
                        </dd>
                    </dl>
                @endif

            </div>
            <div class="modal-footer">
                <button type="button" wire:click="close" class="btn btn-secondary mx-0" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>