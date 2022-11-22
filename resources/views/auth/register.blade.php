@extends('site.main')

@section('title')
    Crear Cuenta -
@endsection

@section('contenido')

    <div class="container-fluid bg-light">
        <div class="container">

            <div class="row vh-100 justify-content-center align-items-center">
                <div class="col-lg-6">

                    <div class="text-center mb-5">
                        <i class="bi bi-person-plus bi-4x text-primary"></i>
                        <h1 class="h2 fw-light">Crear Cuenta</h1>
                        <p class="text-muted">Lorem Ipsum es simplemente el texto de relleno de las imprentas y archivos de texto.</p>
                    </div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf                    

                        <div class="row g-4">
                            <div class="col-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" placeholder="Nombre" value="{{ old('name') }}">
                                    <label for="name">Nombre</label>
                                    @error('name')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('surname') is-invalid @enderror" id="surname" name="surname" placeholder="Apellido" value="{{ old('surname') }}">
                                    <label for="surname">Apellido</label>
                                    @error('surname')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('dni') is-invalid @enderror" id="dni" name="dni" placeholder="DNI" value="{{ old('dni') }}">
                                    <label for="dni">DNI</label>
                                    @error('dni')
                                        <span class="invalid-feedback">
                                            {{ $message }}
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-floating">
                                    <input type="text" class="form-control @error('email') is-invalid @enderror" id="email" name="email" placeholder="Correo Electrónico" value="{{ old('email') }}">
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
                                    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Contraseña">
                                    <label for="password_confirmation">Confirmar Contraseña</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100">Crear</button>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
            
        </div>
    </div>

@endsection
