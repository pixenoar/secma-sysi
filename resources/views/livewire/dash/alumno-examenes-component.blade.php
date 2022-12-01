<div>

    @include('dash.includes.header-alumno')

    <div class="p-4 p-lg-5">

        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold mb-0">Examenes Rendidos</h5>
            </div>
            <div></div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table table-striped align-middle">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Curso</th>
                                <th scope="col">Fecha</th>
                                <th scope="col">Calificación</th>
                                <th scope="col">Nota</th>
                                <th scope="col">Válido hasta</th>
                                <th scope="col">Observaciones</th>
                                <th scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($evaluaciones as $evaluacion)
                                <tr>
                                    <th scope="row">{{ $loop->iteration }}</th>
                                    <td>{{ $evaluacion->examen->curso->nombre }}</td>
                                    <td>{{ $evaluacion->updated_at->format('d/m/Y') }}</td>
                                    <td>{{ $evaluacion->calificacion() }}</td>
                                    <td>
                                        @if($evaluacion->estado == 'C')
                                            @if($evaluacion->nota == 'A')
                                                <span class="badge bg-success">APROBADO</span>
                                            @else
                                                <span class="badge bg-danger">DESAPROBADO</span>
                                            @endif
                                        @endif
                                    </td>
                                    <td>{{ $evaluacion->vigencia() }}</td>
                                    <td>
                                        @if($evaluacion->estado == 'I')
                                            <span class="badge bg-warning">INCOMPLETO</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('certificado', $evaluacion) }}" class="btn btn-primary btn-sm @if ($evaluacion->nota <> 'A') disabled @endif" role="button" title="Descargar certificado"><i class="bi bi-download"></i></a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center">No se encontraron examenes</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>  

            </div>
        </div>

    </div>

</div>