<div wire:ignore.self class="modal fade" id="modalCurso" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalCursoLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalCursoLabel">Detalle del curso</h5>
            </div>
            <div class="modal-body">

                @if($icMoCurso)

                    <div class="row g-4">
                        <div class="col-lg-4">
                            @if($icMoCurso->imagen)
                                <img src="{{ Storage::url($icMoCurso->imagen) }}" alt="Imagen" class="img-fluid rounded">
                            @endif
                        </div>
                        <div class="col-lg-8">
                            <dl class="row gy-1 mb-0">
                                <dt class="col-lg-4">Categoría</dt>
                                <dd class="col-lg-8">{{ $icMoCurso->categoria->nombre }}</dd>
                                <dt class="col-lg-4">Nombre</dt>
                                <dd class="col-lg-8">{{ $icMoCurso->nombre }}</dd>
                                <dt class="col-lg-4">Descripción</dt>
                                <dd class="col-lg-8">{{ $icMoCurso->descripcion }}</dd>
                                <dt class="col-lg-4">Autor</dt>
                                <dd class="col-lg-8">{{ $icMoCurso->autor }}</dd>
                                <dt class="col-lg-4">Profesor</dt>
                                <dd class="col-lg-8">{{ $icMoCurso->profesor->nombre.' '.$icMoCurso->profesor->apellido }}</dd>
                            </dl>
                        </div>
                    </div>

                    <h5 class="mt-5 mb-3">Materiales de estudio</h5>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nombre</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($icMoCurso->materiales as $material)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td><a href="@if($material->tipo=='A') {{ Storage::url($material->url) }} @else {{ $material->url }} @endif" target="_blank" class="text-decoration-none">{{ $material->nombre }}</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="text-center">No se encontraron materiales</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>  

                @endif

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary mx-0" data-bs-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>