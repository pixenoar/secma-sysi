<?php

namespace App\Http\Livewire\Dash;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
Use Carbon\Carbon;
use PDF;

use App\Models\Puesto;
use App\Models\Curso;
use App\Models\Examen;
use App\Models\Evaluacion;
use App\Models\Respuesta;

class AlumnoCursosComponent extends Component{

    public $moPuesto;
    
    public $icMoCurso;

    public $heMoExamen;
    public $heMoEvaluaciones;

    public $exMoExamen;

    public $reMoExamen;
    public $reEvaluacion;
    public $reTiempo;
    public $reCronometro;
    public $reContadorPregunta = 1;
    public $reProgreso = 0;
    public $reMoPreguntas;
    public $reRespuestas = [];

    public function mount(){
        $usuario = session('empresa')->usuarios->where('id', Auth::user()->id)->first();
        $this->moPuesto = Puesto::find($usuario->pivot->puesto_id);
    }


    public function curso(Curso $curso){
        $this->icMoCurso = $curso;
    }

    // RENDIR EXAMEN

    public function rendir(Examen $examen){
        $this->exMoExamen = $examen;
    }

    public function comenzar(Examen $examen){
        $this->reMoExamen = $examen;

        $this->reEvaluacion = new Evaluacion;
        $this->reEvaluacion->examen_id = $this->reMoExamen->id;
        $this->reEvaluacion->user_id = Auth::user()->id;
        $this->reEvaluacion->empresa_id = session('empresa')->id;
        $this->reEvaluacion->save();

        $this->setCronometro();

        $this->reMoPreguntas = $this->reMoExamen->preguntas->shuffle();
    }

    public function responder(){


        foreach($this->reRespuestas as $respuesta_id){

            $respuesta = new Respuesta;
            $respuesta->evaluacion_id = $this->reEvaluacion->id;
            $respuesta->pregunta_id = $this->reMoPreguntas->first()->id;
            $respuesta->opcion_id = $respuesta_id;
            $respuesta->save();

        }
        
        $this->reset('reRespuestas');

        $this->reProgreso = ($this->reContadorPregunta * 100) / $this->reMoExamen->preguntas->count();
        $this->reMoPreguntas->shift();

        $this->setCronometro();

        if($this->reMoPreguntas->count()){
            $this->reContadorPregunta++;
        }else{

            $correctas = 0;
            $incorrectas = false;
            $excluyente = false;

            foreach($this->reMoExamen->preguntas->sortBy('orden') as $pregunta){

                foreach($pregunta->opciones->whereNotNull('correcta')->sortBy('id') as $opcion){
                    $respuestas = $this->reEvaluacion->respuestas->where('opcion_id', $opcion->id);
                    if(!$respuestas->count()){
                        $incorrectas = true;
                        if($pregunta->excluyente){
                            $excluyente = true;
                        }
                    }
                }

                if($incorrectas){
                    $incorrectas = false;
                }else{
                    $correctas++;
                }

            }

            $porcentaje = ($correctas*100)/$this->reMoExamen->preguntas->count();
            if($porcentaje >= $this->reMoExamen->porcentaje_aprobacion && !$excluyente){
                $nota = 'A';
            }else{
                $nota = 'D';
            }

            $this->reEvaluacion->estado = 'C';
            $this->reEvaluacion->nota = $nota;
            $this->reEvaluacion->calificacion = $porcentaje;
            $this->reEvaluacion->save();

            $this->reset(['reProgreso', 'reContadorPregunta']);

            $this->reEvaluacion->refresh();

        }
        
        
    }

    public function cuentaRegresiva(){
        if($this->reTiempo){
            $this->reTiempo--;
            $this->reCronometro->subSeconds(1);
        }else{
            $this->responder();
        }
    }

    private function setCronometro(){
        $this->reTiempo = $this->reMoExamen->tiempo_responder;
        $this->reCronometro = Carbon::create(0,0,0,0,0,0);
        $this->reCronometro->addSeconds($this->reMoExamen->tiempo_responder);
    }


    // --------

    
    public function render(){
        return view('livewire.dash.alumno-cursos-component')->layout('dash.main');
    }

}