@extends('site.main')


@section('contenido')

    <div class="text-center mt-5">
        <h1 class="mb-5 fw-light">Página Web</h1>
        <a href="{{ route('login') }}" class="btn btn-primary fw-bold" role="button">Login</a>
    </div>

@endsection