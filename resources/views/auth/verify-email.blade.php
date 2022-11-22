@extends('site.main')

@section('title')
    Verificar correo electrónico -
@endsection

@section('contenido')

    <div class="container-fluid bg-light">
        <div class="container">

            <div class="row vh-100 justify-content-center align-items-center">
                <div class="col-lg-6">

                    <div class="text-center mb-5">
                        <i class="bi bi-envelope-check bi-4x text-primary"></i>
                        <h1 class="h2 fw-light">Verificar correo electrónico</h1>
                        <p class="text-muted">Antes de comenzar a usar la plataforma, <span class="fw-bold">¿podría verificar su dirección de correo electrónico haciendo clic en el enlace que le acabamos de enviar?</span> Si no recibiste el correo electrónico, con gusto te enviaremos otro.</p>
                    </div>

                    <div class="row g-3">
                        <div class="col-lg-8">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf                    
                                <button type="submit" class="btn btn-outline-primary w-100">Reenviar correo electrónico de verificación</button>
                            </form>
                        </div>
                        <div class="col-lg-4">
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf                    
                                <button type="submit" class="btn btn-primary w-100">Cerrar Sesión</button>
                            </form>
                        </div>
                        <div class="col-lg-12">
                            @if (session('status'))
                                <div class="alert alert-success small m-0">
                                    <i class="bi bi-info-circle-fill me-2"></i> {{ session('status') }}
                                </div>
                            @endif
                        </div>
                    </div>

                </div>
            </div>
            
        </div>
    </div>

@endsection
