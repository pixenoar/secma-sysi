<div wire:ignore.self class="modal fade" id="modalShow" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalShowLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title fw-bold" id="modalShowLabel">Información del curso</h5>
            </div>
            <div class="modal-body">

                @if($moCurso)
                    <dl class="row gy-3 mb-0">
                        <dt class="col-lg-4">Categoría</dt>
                        <dd class="col-lg-8">{{ $moCurso->categoria->nombre }}</dd>
                        <dt class="col-lg-4">Nombre</dt>
                        <dd class="col-lg-8">{{ $moCurso->nombre }}</dd>
                        <dt class="col-lg-4">Descripción</dt>
                        <dd class="col-lg-8">{{ $moCurso->descripcion }}</dd>
                        <dt class="col-lg-4">Autor</dt>
                        <dd class="col-lg-8">{{ $moCurso->autor }}</dd>
                        <dt class="col-lg-4">Profesor</dt>
                        <dd class="col-lg-8">{{ $moCurso->profesor->nombre.' '.$moCurso->profesor->apellido }}</dd>
                        <dt class="col-lg-4">Duración</dt>
                        <dd class="col-lg-8">{{ $moCurso->horas }} hs.</dd>
                        <dt class="col-lg-4">Imagen</dt>
                        <dd class="col-lg-8">
                            @if($moCurso->imagen)
                                <img src="{{ Storage::url($moCurso->imagen) }}" alt="Imagen" class="img-fluid rounded w-50">
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