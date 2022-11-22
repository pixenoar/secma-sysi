<div>

    <div class="p-4 p-lg-5">

        <h4 class="fw-bold mb-5">Dashboard del Sistema</h4>
        
        <div class="row gy-3">
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body px-4">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h1 class="display-6 fw-bold mb-0">{{ $coEmpresas }}</h1>
                                <h2 class="h6 fw-light mb-0">EMPRESAS</h2>
                            </div>
                            <div class="col-4 text-end">
                                <i class="bi bi-building bi-3x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body px-4">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h1 class="display-6 fw-bold mb-0">{{ $coUsuarios }}</h1>
                                <h2 class="h6 fw-light mb-0">USUARIOS ÚNICOS</h2>
                            </div>
                            <div class="col-4 text-end">
                                <i class="bi bi-people bi-3x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="card border-0 shadow-sm">
                    <div class="card-body px-4">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h1 class="display-6 fw-bold mb-0">{{ $coCursos }}</h1>
                                <h2 class="h6 fw-light mb-0">CURSOS</h2>
                            </div>
                            <div class="col-4 text-end">
                                <i class="bi bi-journals bi-3x text-primary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
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
        </div>

        <div class="card border-0 shadow-sm mt-5">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Empresa</th>
                                <th scope="col">Usuarios</th>
                                <th scope="col">Cursos</th>
                                <th scope="col">Evaluaciones</th>
                                <th scope="col">Cumplimiento</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($moEmpresas as $empresa)
                                <tr @if($empresa->id==1) class="table-primary" @endif>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $empresa->razon_social }}</td>
                                    <td>{{ $empresa->usuarios->count() }}</td>
                                    <td>{{ $empresa->cursos->count() }}</td>
                                    <td>{{ $empresa->evaluaciones->count() }}</td>
                                    <td>{{ $empresa->cumplimiento() }} %</td>
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

</div>