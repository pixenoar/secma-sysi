<div>

    <div class="p-4 p-lg-5">

        <div class="row justify-content-center">
            <div class="col-lg-4">
                <div class="text-center mb-5">
                    <i class="bi bi-person-circle bi-4x"></i>
                    <h3>{{ Auth::user()->name.' '.Auth::user()->surname }}</h3>                    
                </div>


                <h5>Modificar Contraseña</h5>
                <form wire:submit.prevent="update">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="row gy-3">
                                @if(session()->has('ok'))
                                    <div class="col-12">
                                        <div class="alert alert-success small mb-0" role="alert"><i class="bi bi-check-circle-fill me-2"></i> {{ session('ok') }}</div>
                                    </div>
                                @endif
                                @if(session()->has('error'))
                                    <div class="col-12">
                                        <div class="alert alert-danger small mb-0" role="alert"><i class="bi bi-exclamation-circle-fill me-2"></i> {{ session('error') }}</div>
                                    </div>
                                @endif
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control @error('password_current') is-invalid @enderror" id="password_current" wire:model.defer="password_current" placeholder="Contraseña actual">
                                        <label for="password_current">Contraseña actual</label>
                                        @error('password_current')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" wire:model.defer="password" placeholder="Contraseña nueva">
                                        <label for="password">Contraseña nueva</label>
                                        @error('password')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-floating">
                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" wire:model.defer="password_confirmation" placeholder="Confirmar contraseña">
                                        <label for="password_confirmation">Repetir contraseña</label>
                                        @error('password_confirmation')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 text-end">
                                    <button type="submit" class="btn btn-primary" wire:target="update" wire:loading.class="disabled">
                                        <div wire:loading.remove wire:target="update">
                                            Guardar
                                        </div>                        
                                        <div wire:loading wire:target="update">
                                            Guardando...
                                        </div>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>

</div>