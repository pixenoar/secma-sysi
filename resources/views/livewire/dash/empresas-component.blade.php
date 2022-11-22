<div>
   
    <div class="p-4 p-lg-5">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold mb-0">Empresas</h5>
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
                                <th scope="col">Razón Social</th>
                                <th scope="col">Estado</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($moEmpresas as $empresa)
                                <tr @if(!$empresa->estado) class="table-danger" @endif>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $empresa->razon_social }}</td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" role="switch" wire:click="estado({{ $empresa->id }})" class="form-check-input" @if($empresa->estado) checked @endif>
                                        </div>
                                    </td>
                                    <td>
                                        <a href="{{ route('empresas.dashboard.index', $empresa) }}" class="btn btn-primary btn-sm" role="button"><i class="bi bi-gear"></i></a>
                                        <button type="button" wire:click="show({{ $empresa->id }})" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalShow"><i class="bi bi-info-lg"></i></button>
                                        <button type="button" wire:click="edit({{ $empresa->id }})" class="btn btn-secondary btn-sm" data-bs-toggle="modal" data-bs-target="#modalEdit"><i class="bi bi-pencil"></i></button>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center">No se encontraron empresas</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

    @include('dash.lwempresas.create')

    @include('dash.lwempresas.edit')

    @include('dash.lwempresas.show')

    @include('dash.lwempresas.delete')


</div>