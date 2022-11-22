<div>

    @if(session('rol')->id == 3)
        @include('dash.includes.header-responsable')
    @else
        @include('dash.includes.header-empresa')
    @endif

    <div class="p-4 p-lg-5">
        
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold mb-0">Cursos</h5>
            </div>
            <div>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCreate">Nuevo</button>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($cursos as $curso)
                                <tr @if(!$curso->estado) class="table-danger" @endif>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $curso->nombre }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" role="switch" wire:click="estado({{ $curso->id }})" class="form-check-input" @if($curso->estado) checked @endif>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" wire:click="materiales({{ $curso->id }})" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalMateriales"><i class="bi bi-paperclip"></i></button>
                                        <button type="button" wire:click="examen({{ $curso->id }})" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalExamen"><i class="bi bi-list-task"></i></button>
                                        <button type="button" wire:click="show({{ $curso->id }})" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalShow"><i class="bi bi-info-lg"></i></button>
                                        <button type="button" wire:click="edit({{ $curso->id }})" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit"><i class="bi bi-pencil"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No se encontraron cursos</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    
    @include('dash.lwcursos.create')

    @include('dash.lwcursos.edit')

    @include('dash.lwcursos.show')

    @include('dash.lwcursos.delete')

    @include('dash.lwcursos.materiales')

    @include('dash.lwcursos.examen')

    @include('dash.lwcursos.examen.create-pregunta')

    @include('dash.lwcursos.examen.edit-pregunta')

    @include('dash.lwcursos.examen.delete-pregunta')

    @include('dash.lwcursos.examen.create-opcion')

    @include('dash.lwcursos.examen.edit-opcion')

    @include('dash.lwcursos.examen.delete-opcion')


</div>