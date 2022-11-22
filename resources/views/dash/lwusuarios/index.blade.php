@extends('dash.index')

@section('empresa')
    {{ $empresa->razon_social }}
@endsection

@section('contenidoo')

    @livewire('dash.usuarios', ['moEmpresa' => $empresa])

@endsection