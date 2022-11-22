@extends('site.main')

@section('title')
    Restablecer Contraseña -
@endsection

@section('contenido')

    <div class="container-fluid bg-light">
        <div class="container">

            <div class="row vh-100 justify-content-center align-items-center">
                <div class="col-lg-4">

                    <div class="text-center mb-5">
                        <i class="bi bi-shield-lock bi-3x text-primary"></i>
                        <h1 class="h3 fw-light">Restablecer Contraseña</h1>
                    </div>

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="row g-3">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $request->email) }}" placeholder="Correo Electrónico">
                                    <label for="email">Correo Electrónico</label>
                                    @error('email')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" placeholder="Contraseña">
                                    <label for="password">Contraseña</label>
                                    @error('password')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Contraseña">
                                    <label for="password_confirmation">Confirmar Contraseña</label>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <button type="submit" class="btn btn-primary w-100">Guardar</button>
                            </div>
                            <div class="col-lg-12">
                                @if (session('status'))
                                    <div class="alert alert-success m-0">
                                        <i class="bi bi-info-circle-fill me-2"></i> {{ session('status') }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
        </div>
    </div>

@endsection