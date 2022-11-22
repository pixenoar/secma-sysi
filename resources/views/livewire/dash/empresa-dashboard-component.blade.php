<div>

    @if(session('rol')->id == 3)
        @include('dash.includes.header-responsable')
    @else
        @include('dash.includes.header-empresa')
    @endif

    <div class="p-4 p-lg-5">
    
        <h4 class="fw-bold mb-5">Dashboard</h4>

        <div class="row gy-3">
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body px-4">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h1 class="display-6 fw-bold mb-0">{{ $coUsuarios }}</h1>
                                <h2 class="h6 fw-light mb-0">USUARIOS</h2>
                            </div>
                            <div class="col-4 text-end">
                                <i class="bi bi-people bi-3x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body px-4">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h1 class="display-6 fw-bold mb-0">{{ $coEvaluaciones }}</h1>
                                <h2 class="h6 fw-light mb-0">EVALUACIONES</h2>
                            </div>
                            <div class="col-4 text-end">
                                <i class="bi bi-ui-checks bi-3x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card border-0 shadow-sm">
                    <div class="card-body px-4">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h1 class="display-6 fw-bold mb-0">{{ $poCumplimiento }} %</h1>
                                <h2 class="h6 fw-light mb-0">CUMPLIMIENTO</h2>
                            </div>
                            <div class="col-4 text-end">
                                <i class="bi bi-hand-thumbs-up bi-3x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h5 class="mt-5 mb-3">Sectores</h5>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Sector</th>
                                <th scope="col">Usuarios</th>
                                <th scope="col">Evaluaciones</th>
                                <th scope="col">Cumplimiento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($moEmpresa->getOrganigrama( session('rol')->id == 3 ? session('sector')->id : 0 ) as $sector)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $sector->nombre }}</td>
                                    <td>{{ $sector->usuarios($moEmpresa) }}</td>
                                    <td>{{ $sector->evaluaciones($moEmpresa) }}</td>
                                    <td>{{ $sector->cumplimiento($moEmpresa) }} %</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center">No se encontraron sectores</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>

</div>