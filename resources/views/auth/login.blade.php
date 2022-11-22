@extends('site.main')

@section('title')
    Login -
@endsection

@section('contenido')

    <div class="container-fluid bg-light">
        <div class="container">

            <div class="row vh-100 justify-content-center align-items-center">
                <div class="col-lg-4">

                    <div class="text-center mb-5">
                        <img src="{{ asset('img/logo.svg') }}" alt="Logo" class="img-fluid d-block mx-auto mb-4">
                        <h1 class="h2 fw-light">Iniciar Sesión</h1>
                    </div>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf                    

                        <div class="row gy-4">
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Correo Electrónico">
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
                            <div class="col-4">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label" for="remember">Recordarme</label>
                                </div>
                            </div>
                            <div class="col-8 text-end">
                                <a href="{{ route('password.request') }}" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100">Ingresar</button>
                            </div>
                            <div class="col-lg-12">
                                @if(session('status'))
                                    <div class="alert alert-success small m-0">
                                        <i class="bi bi-info-circle-fill me-2"></i> {{ session('status') }}
                                    </div>
                                @endif
                                @if(session('bloqueado'))
                                    <div class="alert alert-danger small mb-0">
                                        <i class="bi bi-exclamation-circle-fill me-2"></i> {{ session('bloqueado') }}
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
