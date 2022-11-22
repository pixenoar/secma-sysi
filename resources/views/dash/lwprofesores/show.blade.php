<div wire:ignore.self class="modal fade" id="modalShow" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalShowLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalShowLabel">Información del profesor</h5>
            </div>
            <div class="modal-body">

                @if($moProfesor)
                    <dl class="row gy-3 mb-0">
                        <dt class="col-lg-4">Nombre</dt>
                        <dd class="col-lg-8">{{ $moProfesor->nombre }}</dd>
                        <dt class="col-lg-4">Apellido</dt>
                        <dd class="col-lg-8">{{ $moProfesor->apellido }}</dd>
                        <dt class="col-lg-4">DNI</dt>
                        <dd class="col-lg-8">{{ $moProfesor->dni }}</dd>
                        <dt class="col-lg-4">Email</dt>
                        <dd class="col-lg-8">{{ $moProfesor->email }}</dd>
                        <dt class="col-lg-4">Teléfono</dt>
                        <dd class="col-lg-8">{{ $moProfesor->telefono }}</dd>
                        <dt class="col-lg-4">Título</dt>
                        <dd class="col-lg-8">{{ $moProfesor->titulo }}</dd>
                        <dt class="col-lg-4">Matrícula</dt>
                        <dd class="col-lg-8">{{ $moProfesor->matricula }}</dd>
                        <dt class="col-lg-4">Firma</dt>
                        <dd class="col-lg-8">
                            @if($moProfesor->firma)
                                <img src="{{ Storage::url($moProfesor->firma) }}" alt="Firma" class="img-fluid rounded w-50">
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