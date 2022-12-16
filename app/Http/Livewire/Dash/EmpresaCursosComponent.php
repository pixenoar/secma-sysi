<?php

namespace App\Http\Livewire\Dash;

use Livewire\Component;
use Livewire\WithFileUploads;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

use App\Models\Empresa;
use App\Models\Curso;
use App\Models\Categoria;
use App\Models\Profesor;
use App\Models\Material;
use App\Models\Examen;
use App\Models\Pregunta;
use App\Models\Opcion;
use App\Models\Plan;

class EmpresaCursosComponent extends Component{

    use WithFileUploads;

    public $moEmpresa;
    public $moCurso;

    public $moCategorias;
    public $moProfesores;
    public $categoria;
    public $nombre;
    public $descripcion;
    public $autor;
    public $profesor;
    public $horas;
    public $imagen;

    public $matTipo = 'A';
    public $matNombre;
    public $matArchivo;
    public $matUrl;

    public $moExamen;
    public $exaPorcentajeAprobacion;
    public $exaTiempoResponder;
    public $exaTiempoAnticipacionRendir;
    public $exaActivo;

    public $moPregunta;
    public $preDescripcion;
    public $preExcluyente;

    public $moOpcion;
    public $opcTipo = "T";
    public $opcDescripcion;
    public $opcDiapositiva;
    public $opcCorrecta;

    // ----------------

    public function mount(Empresa $moEmpresa){
        $this->moEmpresa = $moEmpresa;
        $this->moOpcion = new Opcion;
        $this->moCategorias = Categoria::orderBy('id')->get();
        $this->moProfesores = $this->moEmpresa->profesores->sortBy('nombre');
    }

    // curso

    public function store(){

        $this->validate([
            'categoria' => 'required',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'profesor' => 'required',
            'horas' => 'required|integer',
            'imagen' => 'required|image|mimes:jpg,png|max:1024',
        ]);

        $curso = new Curso;
        $curso->empresa_id = $this->moEmpresa->id;
        $curso->categoria_id = $this->categoria;
        $curso->profesor_id = $this->profesor;
        $curso->nombre = Str::title($this->nombre);
        $curso->descripcion = $this->descripcion;
        $curso->autor = Str::title($this->autor);
        $curso->horas = $this->horas;

        // upload imagen
        if($this->imagen){
            $path = $this->imagen->store('public/cursos/imagenes');
            Image::make('../storage/app/'.$path)->widen(340)->save();
            $curso->imagen = $path;            
        }

        $curso->save();

        $this->reset(['categoria', 'nombre', 'descripcion', 'autor', 'horas', 'profesor', 'imagen']);

        // creo exámen

        $examen = new Examen;
        $examen->curso_id = $curso->id;
        $examen->save();

        $this->moEmpresa->refresh();

        session()->flash('message', 'ok');
        
    }
    
    public function edit($id){

        $this->moCurso = Curso::find($id);

        $this->categoria = $this->moCurso->categoria_id;
        $this->profesor = $this->moCurso->profesor_id;
        $this->nombre = $this->moCurso->nombre;
        $this->descripcion = $this->moCurso->descripcion;
        $this->autor = $this->moCurso->autor;
        $this->horas = $this->moCurso->horas;
        
    }

    public function update(){

        $this->validate([
            'categoria' => 'required',
            'nombre' => 'required|string|max:255',
            'descripcion' => 'required|string|max:255',
            'autor' => 'required|string|max:255',
            'profesor' => 'required',
            'horas' => 'required|integer',
            'imagen' => 'nullable|image|mimes:jpg,png|max:1024',
        ]);

        
        if($this->moCurso->categoria_id <> $this->categoria || $this->moCurso->nombre <> Str::title($this->nombre)){
            $this->replicarCurso();
        }

        $this->moCurso->categoria_id = $this->categoria;
        $this->moCurso->profesor_id = $this->profesor;
        $this->moCurso->nombre = Str::title($this->nombre);
        $this->moCurso->descripcion = $this->descripcion;
        $this->moCurso->autor = Str::title($this->autor);
        $this->moCurso->horas = $this->horas;

        
        if($this->imagen){
            // delete imagen anterior
            Storage::delete($this->moCurso->imagen);
            // upload imagen
            $path = $this->imagen->store('public/cursos/imagenes');
            Image::make('../storage/app/'.$path)->widen(340)->save();
            $this->moCurso->imagen = $path;            
        }

        $this->moCurso->save();

        $this->reset('imagen');

        $this->moEmpresa->refresh();

        session()->flash('message', 'ok');
        
    }

    public function show($id){
        $this->moCurso = Curso::find($id);
    }

    public function estado($id){
        $moCurso = Curso::find($id);

        if($moCurso->estado){
            $moCurso->estado = 0;
        }else{
            $moCurso->estado = 1;
        }

        $moCurso->save();
    }

    public function close(){
        $this->reset(['moCurso', 'categoria', 'nombre', 'descripcion', 'autor', 'horas', 'profesor', 'imagen']);
        $this->resetValidation();
    }
    
    public function replicarCurso(){
        
        if($this->moCurso->estado){

            // replicar curso
            $newMoCurso = $this->moCurso->replicate();
            $newMoCurso->save();
            
            // replicar examen
            $newMoExamen = $this->moCurso->examen->replicate();
            $newMoExamen->curso_id = $newMoCurso->id;
            $newMoExamen->save();

            // replicar preguntas
            foreach($newMoExamen->preguntas as $pregunta){
                $newMoPregunta = $pregunta->replicate();
                $newMoPregunta->examen_id = $newMoExamen->id;
                $newMoPregunta->save();
                if($this->moPregunta && ( $this->moPregunta->id == $pregunta->id ) ){
                    $this->moPregunta = $newMoPregunta;
                }
                // replicar opciones
                foreach($newMoPregunta->opciones as $opcion){
                    $newMoOpcion = $opcion->replicate();
                    $newMoOpcion->pregunta_id = $newMoPregunta->id;
                    $newMoOpcion->save();
                    if($this->moOpcion && ( $this->moOpcion->id == $opcion->id ) ){
                        $this->moOpcion = $newMoOpcion;
                    }
                }
            }

            Plan::where('curso_id', $this->moCurso->id)->update(['curso_id' => $newMoCurso->id]);
            
            $this->moCurso = $newMoCurso;


        }
        
    }

    // matriales

    public function materiales($curso_id){
        $this->moCurso = Curso::find($curso_id);
    }

    public function matStore(){

        $this->validate([
            'matNombre' => 'required|string|max:255',
            'matArchivo' => 'exclude_if:matTipo,U|required|file|max:5120',
            'matUrl' => 'exclude_if:matTipo,A|required|url|string|max:255',
        ]);

        $material = new Material;
        $material->curso_id = $this->moCurso->id;
        $material->tipo = $this->matTipo;
        $material->nombre = Str::title($this->matNombre);
        
        
        // Upload archivo
        if($this->matTipo=='A'){
            $folder = 'public/cursos/materiales/'.$this->moCurso->id;
            $path = $this->matArchivo->store($folder);
            $material->url = $path;           
        }else{
            $material->url = $this->matUrl;
        }

        $material->save();

        $this->reset(['matTipo', 'matNombre', 'matArchivo', 'matUrl']);
        $this->moCurso->refresh();

        session()->flash('message', 'ok');

    }

    public function matDelete($id){

        $material = Material::find($id);

        if($material->matTipo=='A'){
            Storage::delete($material->url);
        }

        $material->delete();

        $this->moCurso->refresh();

        session()->flash('message', 'ok');


    }

    public function matClose(){
        $this->reset(['matTipo', 'matNombre', 'matArchivo', 'matUrl']);
        $this->resetValidation();
    }

    // examen

    public function examen($curso_id){
        $this->moCurso = Curso::find($curso_id);
        $this->moExamen = $this->moCurso->examen;
        $this->exaPorcentajeAprobacion = $this->moExamen->porcentaje_aprobacion;
        $this->exaTiempoResponder = $this->moExamen->tiempo_responder;
        $this->exaTiempoAnticipacionRendir = $this->moExamen->tiempo_anticipacion_rendir;
        $this->exaActivo = $this->moExamen->activo;
    }

    public function exaUpdate(){

        $this->validate([
            'exaPorcentajeAprobacion' => 'required|integer|digits_between:1,2',
            'exaTiempoResponder' => 'required|integer',
            'exaTiempoAnticipacionRendir' => 'required|integer',
        ]);

        $this->moExamen->porcentaje_aprobacion = $this->exaPorcentajeAprobacion;
        $this->moExamen->tiempo_responder = $this->exaTiempoResponder;
        $this->moExamen->tiempo_anticipacion_rendir = $this->exaTiempoAnticipacionRendir;
        $this->moExamen->save();

        session()->flash('message', 'ok');
    
    }

    public function exaClose(){
        $this->reset(['moExamen', 'exaPorcentajeAprobacion', 'exaTiempoResponder', 'exaTiempoAnticipacionRendir']);
        $this->resetValidation();
    }

    public function exaStoreNewVersion(){
        
        if($this->moCurso->estado){
            // replicar examen
            $newMoExamen = $this->moExamen->replicate();
            $newMoExamen->save();
            // replicar preguntas
            foreach($newMoExamen->preguntas as $pregunta){
                $newMoPregunta = $pregunta->replicate();
                $newMoPregunta->examen_id = $newMoExamen->id;
                $newMoPregunta->save();
                if($this->moPregunta && ( $this->moPregunta->id == $pregunta->id ) ){
                    $this->moPregunta = $newMoPregunta;
                }
                // replicar opciones
                foreach($newMoPregunta->opciones as $opcion){
                    $newMoOpcion = $opcion->replicate();
                    $newMoOpcion->pregunta_id = $newMoPregunta->id;
                    $newMoOpcion->save();
                    if($this->moOpcion && ( $this->moOpcion->id == $opcion->id ) ){
                        $this->moOpcion = $newMoOpcion;
                    }
                }
            }
            
            $this->moExamen = $newMoExamen;


        }
        
    }
    
    // pregunta

    public function preStore(){

        $this->validate([
            'preDescripcion' => 'required|string|max:255',
        ]);

        $this->exaStoreNewVersion();

        /*
        if($this->preExcluyente){
            $preguntaExcluyente = Pregunta::where('examen_id', $this->moExamen->id)->where('excluyente', 1)->first();
            if($preguntaExcluyente){
                $preguntaExcluyente->excluyente = NULL;
                $preguntaExcluyente->save();
            }
        }*/

        $pregunta = new Pregunta;
        $pregunta->examen_id = $this->moExamen->id;
        $pregunta->descripcion = $this->preDescripcion;
        $pregunta->excluyente = $this->preExcluyente;
        $pregunta->orden = (Pregunta::where('examen_id', $this->moExamen->id)->max('orden'))+1;
        $pregunta->save();

        $this->reset(['preDescripcion', 'preExcluyente']);

        session()->flash('message', 'ok');

    }

    public function preEdit($pregunta_id){
        $this->moPregunta = Pregunta::find($pregunta_id);
        $this->preDescripcion = $this->moPregunta->descripcion;
        $this->preExcluyente = $this->moPregunta->excluyente;
    }

    public function preUpdate(){

        $this->validate([
            'preDescripcion' => 'required|string|max:255',
        ]);

        $this->exaStoreNewVersion();

        if($this->preExcluyente){

            $preguntaExcluyente = $this->moExamen->preguntas->where('excluyente', 1)->first();
            
            if($preguntaExcluyente && $preguntaExcluyente->id != $this->moPregunta->id){
                $preguntaExcluyente->excluyente = NULL;
                $preguntaExcluyente->save();
            }

        }

        $this->moPregunta->descripcion = $this->preDescripcion;
        $this->moPregunta->excluyente = $this->preExcluyente;
        $this->moPregunta->save();

        session()->flash('message', 'ok');


    }

    public function preDelete($pregunta_id){
        $this->moPregunta = Pregunta::find($pregunta_id);
    }

    public function preDestroy(){
        $this->exaStoreNewVersion();
        $this->moPregunta->delete();
        $this->moExamen->refresh();
    }

    public function preUp($pregunta_id){
        if($this->moExamen->preguntas->count()>1){
            $pregunta = Pregunta::find($pregunta_id);
            $preguntaPrev = Pregunta::where('examen_id', $this->moExamen->id)->where('orden', ($pregunta->orden-1))->first();
            $pregunta->decrement('orden');
            $preguntaPrev->increment('orden');
            $this->moExamen->refresh();            
        }

    }

    public function preDown($pregunta_id){
        if($this->moExamen->preguntas->count()>1){
            $pregunta = Pregunta::find($pregunta_id);
            $preguntaNext = Pregunta::where('examen_id', $this->moExamen->id)->where('orden', ($pregunta->orden+1))->first();
            $pregunta->increment('orden');
            $preguntaNext->decrement('orden');
            $this->moExamen->refresh();
        }
    }

    public function preClose(){
        $this->reset(['preDescripcion', 'preExcluyente']);
        $this->resetValidation();
    }

    // opción

    public function opcCreate($pregunta_id){
        $this->moPregunta = Pregunta::find($pregunta_id);
    }

    public function opcStore(){

        $this->validate([
            'opcDescripcion' => 'exclude_if:opcTipo,D|required|string|max:255',
            'opcDiapositiva' => 'exclude_if:opcTipo,T|required|image|mimes:jpg,png|max:1024',
        ]);

        $this->exaStoreNewVersion();

        $opcion = new Opcion;
        $opcion->pregunta_id = $this->moPregunta->id;
        $opcion->tipo = $this->opcTipo;
        if($this->opcTipo == 'T'){
            $opcion->descripcion = $this->opcDescripcion;
        }else{
            // Upload diapositiva
            $carpeta = 'public/cursos/imagenes';
            $path = $this->opcDiapositiva->store($carpeta);
            Image::make('../storage/app/'.$path)->widen(960)->save();           
            $opcion->descripcion = $path;
        }
        $opcion->correcta = $this->opcCorrecta;
        $opcion->orden = (Opcion::where('pregunta_id', $this->moPregunta->id)->max('orden'))+1;
        $opcion->save();

        $this->reset(['opcDescripcion', 'opcDiapositiva', 'opcCorrecta']);

        session()->flash('message', 'ok');

    }

    public function opcEdit($pregunta_id, $opcion_id){
        $this->moPregunta = Pregunta::find($pregunta_id);
        $this->moOpcion = Opcion::find($opcion_id);
        $this->opcTipo = $this->moOpcion->tipo;
        $this->opcDescripcion = $this->moOpcion->descripcion;
        $this->opcCorrecta = $this->moOpcion->correcta;
    }

    public function opcUpdate(){

        $this->validate([
            'opcDescripcion' => 'exclude_if:opcTipo,D|required|string|max:255',
            'opcDiapositiva' => 'exclude_if:opcTipo,T|required|image|mimes:jpg,png|max:5120',
        ]);

        $this->exaStoreNewVersion();

        if($this->opcTipo == 'T'){
            $this->moOpcion->descripcion = $this->opcDescripcion;
        }else{
            // Upload diapositiva
            $carpeta = 'public/cursos/imagenes';
            $path = $this->opcDiapositiva->store($carpeta);
            Image::make('../storage/app/'.$path)->widen(960)->save();           
            $this->moOpcion->descripcion = $path;
        }
        $this->moOpcion->tipo = $this->opcTipo;
        $this->moOpcion->correcta = $this->opcCorrecta;
        $this->moOpcion->save();
        $this->moOpcion->refresh(); 

        session()->flash('message', 'ok');

    }

    public function opcDelete($opcion_id){
        $this->moOpcion = Opcion::find($opcion_id);
    }

    public function opcDestroy(){
        $this->exaStoreNewVersion();
        $this->moOpcion->delete();
        $this->moExamen->refresh();

    }

    public function opcUp($pregunta_id, $opcion_id){
        $pregunta = Pregunta::find($pregunta_id);
        if($pregunta->opciones->count()>1){
            $opcion = Opcion::find($opcion_id);
            $opcionPrev = Opcion::where('pregunta_id', $pregunta->id)->where('orden', ($opcion->orden-1))->first();
            $opcion->decrement('orden');
            $opcionPrev->increment('orden');
            $this->moExamen->refresh();            
        }

    }

    public function opcDown($pregunta_id, $opcion_id){
        $pregunta = Pregunta::find($pregunta_id);
        if($pregunta->opciones->count()>1){
            $opcion = Opcion::find($opcion_id);
            $opcionNext = Opcion::where('pregunta_id', $pregunta->id)->where('orden', ($opcion->orden+1))->first();
            $opcion->increment('orden');
            $opcionNext->decrement('orden');
            $this->moExamen->refresh();
        }
    }

    public function opcClose(){
        $this->reset(['opcTipo', 'opcDescripcion', 'opcDiapositiva', 'opcCorrecta']);
        $this->resetValidation();
    }


    public function render(){
        return view('livewire.dash.empresa-cursos-component',[
            'cursos' => $this->moEmpresa->cursos()->orderBy('nombre')->get()
        ])->layout('dash.main');
    }

}
