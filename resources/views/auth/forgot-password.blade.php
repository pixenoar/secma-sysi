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
                        <h1 class="h3 fw-light">¿Olvidaste tu contraseña?</h1>
                        <p class="text-muted">Ingresá el correo electrónico con el que te registraste y te enviaremos instrucciones.</p>
                    </div>

                    <form method="POST" action="{{ route('password.email') }}">
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
                                <button type="submit" class="btn btn-primary w-100">Enviar</button>
                            </div>
                            <div class="col-lg-12">
                                @if (session('status'))
                                    <div class="alert alert-success small mb-0">
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
