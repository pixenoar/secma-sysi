<div>

    @if(session('rol')->id == 3)
        @include('dash.includes.header-responsable')
    @else
        @include('dash.includes.header-empresa')
    @endif

    <div class="p-4 p-lg-5">
    
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold mb-0">Profesores</h5>
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
                            @forelse($profesores as $profesor)
                                <tr @if(!$profesor->estado) class="table-danger" @endif>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $profesor->apellido.', '.$profesor->nombre }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" role="switch" wire:click="estado({{ $profesor->id }})" class="form-check-input" @if($profesor->estado) checked @endif>
                                        </div>
                                    </td>
                                    <td>
                                        <button type="button" wire:click="show({{ $profesor->id }})" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalShow"><i class="bi bi-info-lg"></i></button>
                                        <button type="button" wire:click="edit({{ $profesor->id }})" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit"><i class="bi bi-pencil"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No se encontraron profesores</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    

    @include('dash.lwprofesores.create')

    @include('dash.lwprofesores.edit')

    @include('dash.lwprofesores.show')

    @include('dash.lwprofesores.delete')

</div>