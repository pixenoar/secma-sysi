<div>

    @if(session('rol')->id == 3)
        @include('dash.includes.header-responsable')
    @else
        @include('dash.includes.header-empresa')
    @endif

    <div class="p-4 p-lg-5">
    
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h5 class="fw-bold mb-0">Organigrama</h5>
            </div>
            <div>
                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalCreateSector">Nuevo Sector</button>
            </div>
        </div>

        <div class="card border-0 shadow-sm">
            <div class="card-body">
                @if($moEmpresa->sectores->count())
                    <ul>
                        @foreach($moEmpresa->sectores->where('padre_id', 0)->sortBy('nombre') as $sector)
                            @include('dash.lworganigrama.recursivo-index', $sector)
                        @endforeach
                    </ul>
                @else
                    <p class="text-center mb-0">No se encontraron sectores</p>
                @endif
            </div>
        </div>

    </div>
    
    @include('dash.lworganigrama.create-sector')

    @include('dash.lworganigrama.edit-sector')

    @include('dash.lworganigrama.delete-sector')

    @include('dash.lworganigrama.puestos')

    @include('dash.lworganigrama.edit-puesto')

    @include('dash.lworganigrama.delete-puesto')

    @include('dash.lworganigrama.organigrama')


</div>