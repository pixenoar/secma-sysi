<div>
    
    @if(session('rol')->id == 3)
        @include('dash.includes.header-responsable')
    @else
        @include('dash.includes.header-empresa')
    @endif

    <div class="p-4 p-lg-5">
    
        <h5 class="fw-bold mb-3">Usuarios</h5>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <input type="text" class="form-control" id="busqueda" wire:model="busqueda" placeholder="buscar...">
            </div>
            <div>
                @if($usuarios->count() < $moEmpresa->cupo_user && session('rol')->id < 3)
                    <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCreate" @if($moEmpresa->usuarios->count() >= $moEmpresa->cupo_user) invisible @endif>Nuevo</button>
                @endif
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
                                <th scope="col">DNI</th>
                                <th scope="col">Verificado</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($usuarios as $usuario)
                                <tr @if(!$usuario->estado) class="table-danger" @endif>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $usuario->surname.', '.$usuario->name }}</td>
                                    <td>{{ $usuario->dni }}</td>
                                    <td>
                                        @if($usuario->email_verified_at)
                                            <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" role="switch" wire:click="estado({{ $usuario->id }})" class="form-check-input" @if($usuario->estado) checked @endif>
                                        </div>
                                    </td>
                                    
                                    <td>
                                        <button type="button" wire:click="planes({{ $usuario->id }}, {{ $usuario->pivot->puesto_id }})" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalPlanes" title="Plan de capacitación"><i class="bi bi-calendar-check"></i></button>
                                        <button type="button" wire:click="evaluaciones({{ $usuario->id }})" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEvaluaciones"><i class="bi bi-ui-checks" title="Examenes"></i></button>
                                        <button type="button" wire:click="show({{ $usuario->id }}, {{ $usuario->pivot->puesto_id }})" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalShow" title="Información"><i class="bi bi-info-lg"></i></button>
                                        <button type="button" wire:click="edit({{ $usuario->id }}, {{ $usuario->pivot->puesto_id }}, {{ $usuario->pivot->clon }})" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit" @if(session('rol')->id > 2) disabled @endif title="Modificar"><i class="bi bi-pencil"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="text-center">No se encontraron usuarios</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $usuarios->links() }}
                </div>
            </div>
        </div>

    </div>

    @include('dash.lwusuarios.create')

    @include('dash.lwusuarios.edit')

    @include('dash.lwusuarios.show')

    @include('dash.lwusuarios.delete')

    @include('dash.lwusuarios.planes')

    @include('dash.lwusuarios.evaluaciones')

    @include('dash.lwusuarios.evaluacion')

    @include('dash.includes.modales.organigrama')

</div>
