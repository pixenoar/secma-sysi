<?php

namespace App\Http\Livewire\Dash;

use Livewire\Component;

use App\Models\Empresa;
use App\Models\Curso;
use App\Models\Sector;
use App\Models\Puesto;
use App\Models\Plan;

class EmpresaPlanesComponent extends Component{

    public $moEmpresa;
    public $moCursos;
    public $moSector;
    public $moPuesto;
    public $moPlan;

    public $puesto;
    public $curso;
    public $frecuencia;
    public $cascada;

    public $modal;

    public $fiPuesto;
    public $fiCurso;

    public function mount(Empresa $moEmpresa){
        $this->moEmpresa = $moEmpresa;
        $secmaCursos = Empresa::find(1)->cursos->sortBy('nombre');
        $cursos = $this->moEmpresa->cursos->sortBy('nombre');
        $this->moCursos = $cursos->merge($secmaCursos);
    }

    public function selSector($sector_id){
        $this->reset(['moSector', 'moPuesto', 'moPlan', 'puesto', 'curso', 'frecuencia', 'cascada']);
        $this->moSector = Sector::find($sector_id);
    }
    
    public function updatedCascada(){
        $this->reset(['moPlan', 'puesto', 'curso', 'frecuencia']);
    }

    public function updatedPuesto(){
        $this->reset(['curso', 'frecuencia']);
    }

    public function updatedCurso(){
        $this->reset('frecuencia');
        if($this->puesto){
            $this->moPlan = $this->moEmpresa->planes->where('puesto_id', $this->puesto)->where('curso_id', $this->curso)->first();
            if($this->moPlan){
                $this->frecuencia = $this->moPlan->frecuencia;
                if(!$this->frecuencia){
                    $this->unicaVez = true;
                }
            }
        }
    }

    public function store(){

        $this->validate([
            'moSector' => 'required',
            'puesto' => 'exclude_if:cascada,true|required',
            'curso' => 'required',
            'frecuencia' => 'required|integer',
        ]);

        if($this->cascada){
            $this->recursivoDel($this->moSector);
            $this->recursivoAdd($this->moSector);
        }else{
            if($this->moPlan){
                $this->moPlan->frecuencia = $this->frecuencia;
                $this->moPlan->save();
            }else{    
                $plan = new Plan;
                $plan->empresa_id = $this->moEmpresa->id;
                $plan->puesto_id = $this->puesto;
                $plan->curso_id = $this->curso;
                $plan->frecuencia = $this->frecuencia;
                $plan->save();                
            }
        }

        $this->reset(['moSector', 'moPuesto', 'moPlan', 'puesto', 'curso', 'frecuencia', 'cascada']);

        $this->moEmpresa->refresh();

        session()->flash('message', 'ok');

    }

    public function destroy(){

        $this->validate([
            'moSector' => 'required',
            'puesto' => 'exclude_if:cascada,true|required',
            'curso' => 'required'
        ]);

        if($this->cascada){
            $this->recursivoDel($this->moSector);
        }else{
            if($this->moPlan){
                $this->moPlan->delete();
            }
        }

        $this->reset(['moSector', 'moPuesto', 'moPlan', 'puesto', 'curso', 'frecuencia', 'cascada']);

        $this->moEmpresa->refresh();

        session()->flash('message', 'ok');

    }

    public function modal($modal){
        $this->modal = $modal;
    }

    public function limpiarFiltros(){
        $this->reset(['moSector', 'fiPuesto', 'fiCurso']);
    }



    public function close(){
        $this->reset(['moSector', 'moPuesto', 'moPlan', 'puesto', 'curso', 'frecuencia', 'cascada']);
        $this->resetValidation();
    }


    // --------

    public function render(){
        return view('livewire.dash.empresa-planes-component',[
            'planes' => $this->moEmpresa->planes()->
                                          when($this->fiPuesto, function($query, $puesto_id){ $query->where('puesto_id', $puesto_id); })->
                                          when($this->fiCurso, function($query, $curso_id){ $query->where('curso_id', $curso_id); })->
                                          orderBy('puesto_id')->
                                          get()
        ])->layout('dash.main');
    }

    // ---------



    
    private function recursivoDel(Sector $sector){

        foreach($sector->puestos as $puesto){
            Plan::destroy($puesto->planes->where('curso_id', $this->curso));
        }

        foreach(Sector::where('padre_id', $sector->id)->get() as $sector){
            $this->recursivoDel($sector);
        }

    }

    private function recursivoAdd(Sector $sector){

        foreach($sector->puestos as $puesto){
            $plan = new Plan;
            $plan->empresa_id = $this->moEmpresa->id;
            $plan->puesto_id = $puesto->id;
            $plan->curso_id = $this->curso;
            $plan->frecuencia = $this->frecuencia;
            $plan->save();
        }

        foreach(Sector::where('padre_id', $sector->id)->get() as $sector){
            $this->recursivoAdd($sector);
        }

    }

}
