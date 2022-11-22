<li class="my-3">
    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
        <button type="button" class="btn btn-outline-primary">{{ $sector->nombre }}</button>
        <button type="button" wire:click="puestos({{ $sector->id }})" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalPuestos"><i class="bi bi-file-person"></i></button>
        <button type="button" wire:click="editSector({{ $sector->id }})" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#modalEditSector"><i class="bi bi-pencil"></i></button>
    </div>
</li>
@if(count($moEmpresa->sectores->where('padre_id', $sector->id)))
    <ul>
        @foreach($moEmpresa->sectores->where('padre_id', $sector->id)->sortBy('nombre') as $sector)
            @include('dash.lworganigrama.recursivo-index', $sector)
        @endforeach
    </ul>
@endif