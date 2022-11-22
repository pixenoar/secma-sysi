<div wire:ignore.self class="modal fade" id="modalShow" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalShowLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShowLabel">Información de la Empresa</h5>
            </div>
            <div class="modal-body">

                @if($moEmpresa)
                    <dl class="row gy-3 mb-0">
                        <dt class="col-lg-6">Razón Social</dt>
                        <dd class="col-lg-6">{{ $moEmpresa->razon_social }}</dd>
                        <dt class="col-lg-6">CUIT</dt>
                        <dd class="col-lg-6">{{ $moEmpresa->cuit }}</dd>
                        <dt class="col-lg-6">Dirección</dt>
                        <dd class="col-lg-6">{{ $moEmpresa->direccion }}</dd>
                        <dt class="col-lg-6">Teléfono</dt>
                        <dd class="col-lg-6">{{ $moEmpresa->telefono }}</dd>
                        <dt class="col-lg-6">Usuarios Permitidos</dt>
                        <dd class="col-lg-6">{{ $moEmpresa->cupo_user }}</dd>
                        <dt class="col-lg-6">Costo por Usuario</dt>
                        <dd class="col-lg-6">$ {{ number_format($moEmpresa->costo_user, 0, ',', '.') }}</dd>
                        <dt class="col-lg-6">Logotipo</dt>
                        <dd class="col-lg-6">
                            @if($moEmpresa->logo)
                                <img src="{{ Storage::url($moEmpresa->logo) }}" alt="Imagen" class="img-fluid rounded w-50">
                            @endif
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