<div wire:ignore.self class="modal fade" id="modalEdit" data-bs-backdrop="static" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditLabel">Modificar Curso</h5>
            </div>
            <form wire:submit.prevent="update">
                <div class="modal-body position-relative py-4">
                    @if(session()->has('message'))
                        <div class="position-absolute top-100 start-50 translate-middle bg-white">
                            <i class="bi bi-check-circle-fill fs-3 text-success"></i>
                        </div>  
                    @endif
                    <div class="row g-3">
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <select class="form-select @error('categoria') is-invalid @enderror" id="categoria" wire:model.defer="categoria">
                                    <option value="" selected>Seleccionar</option>
                                    @foreach($moCategorias as $moCategoria)
                                        <option value="{{ $moCategoria->id }}">{{ $moCategoria->nombre }}</option>
                                    @endforeach
                                </select>
                                <label for="categoria">Categoría</label>
                                @error('categoria')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div> 
                        </div>
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('nombre') is-invalid @enderror" id="nombre" wire:model.defer="nombre" placeholder="Nombre">
                                <label for="nombre">Nombre</label>
                                @error('nombre')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <textarea class="form-control @error('descripcion') is-invalid @enderror" placeholder="Descripción" id="descripcion" wire:model.defer="descripcion" style="height: 7rem"></textarea>
                                <label for="descripcion">Descripción</label>
                                @error('descripcion')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('autor') is-invalid @enderror" id="autor" wire:model.defer="autor" placeholder="Autor">
                                <label for="autor">Autor</label>
                                @error('autor')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <select class="form-select @error('profesor') is-invalid @enderror" id="profesor" wire:model.defer="profesor">
                                    <option value="" selected>Seleccionar</option>
                                    @foreach($moProfesores->where('estado', 1) as $moProfesor)
                                        <option value="{{ $moProfesor->id }}">{{ $moProfesor->nombre.' '.$moProfesor->apellido }}</option>
                                    @endforeach
                                </select>
                                <label for="profesor">Profesor</label>
                                @error('profesor')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div> 
                        </div>
                        <div class="col-lg-12">
                            <div class="form-floating">
                                <input type="text" class="form-control @error('horas') is-invalid @enderror" id="horas" wire:model.defer="horas" placeholder="Horas de Capacitación">
                                <label for="horas">Duración (horas)</label>
                                @error('horas')
                                    <span class="invalid-feedback">
                                        {{ $message }}
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="border rounded p-3">
                                <div class="row align-items-end g-3">
                                    <div class="col-lg-2">
                                        @if($moCurso)
                                            <img src="{{ Storage::url($moCurso->imagen) }}" class="img-fluid rounded" alt="Imagen">
                                        @endif
                                    </div>
                                    <div class="col-lg-10">
                                        <label for="imagen" class="form-label">Adjuntar Imagen</label>
                                        <input class="form-control @error('imagen') is-invalid @enderror" type="file" wire:model="imagen" id="imagen">
                                        @error('imagen')
                                            <span class="invalid-feedback">
                                                {{ $message }}
                                            </span>
                                        @enderror                                    
                                    </div>
                                </div>
                            </div>
                        </div>                     

                    </div>
                 
                </div>
                <div class="modal-footer">
                    <button type="button" wire:click="close" class="btn btn-secondary mx-0" data-bs-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary" wire:target="update" wire:loading.class="disabled">
                        <div wire:loading.remove wire:target="update">
                            Guardar
                        </div>                        
                        <div wire:loading wire:target="update">
                            Guardando...
                        </div>
                    </button>
                </div>
            </form> 
        </div>
    </div>
</div>