<li class="py-1">
    <a href="#" wire:click="selSector({{ $sector->id }})" class="text-decoration-none" data-bs-toggle="modal" data-bs-target="#modal{{ $modal }}">{{ $sector->nombre }}</a>
</li>
@if(count($moEmpresa->sectores->where('padre_id', $sector->id)))
    <ul>
        @foreach($moEmpresa->sectores->where('padre_id', $sector->id)->sortBy('nombre') as $sector)
            @include('dash.lwplanes.recursivo', $sector)
        @endforeach
    </ul>
@endif