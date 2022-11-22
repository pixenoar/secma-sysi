<div>

    @if(session('rol')->id == 3)
        @include('dash.includes.header-responsable')
    @else
        @include('dash.includes.header-empresa')
    @endif

    <div class="p-4 p-lg-5">
        
        <h5 class="fw-bold mb-3">Planes</h5>
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <button type="button" class="btn btn-primary btn-sm" wire:click="modal('Filter')" data-bs-toggle="modal" data-bs-target="#modalFilter"><i class="bi bi-funnel-fill"></i> Filtrar</button>
            </div>
            <div>
                <button type="button" class="btn btn-primary btn-sm" wire:click="modal('Create')" data-bs-toggle="modal" data-bs-target="#modalCreate">Nuevo</button>
                <button type="button" class="btn btn-danger btn-sm" wire:click="modal('Delete')" data-bs-toggle="modal" data-bs-target="#modalDelete"><i class="bi bi-trash"></i></button>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Sector</th>
                                <th scope="col">Puesto</th>
                                <th scope="col">Curso</th>
                                <th scope="col">Frecuencia</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($planes as $plan)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $plan->puesto->sector->nombre }}</td>
                                    <td>{{ $plan->puesto->nombre }}</td>
                                    <td>{{ $plan->curso->nombre }}</td>
                                    <td>{{ $plan->frecuencia() }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center">No se encontraron planes</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @include('dash.lwplanes.create')

    @include('dash.lwplanes.delete')

    @include('dash.lwplanes.filter')
    
    @include('dash.lwplanes.organigrama')

</div>