<?php

namespace App\Http\Livewire\Dash;

use Livewire\Component;

use App\Models\Empresa;
use App\Models\User;
use App\Models\Curso;
use App\Models\Evaluacion;

class DashboardComponent extends Component{

    public $coEmpresas;
    public $coUsuarios;
    public $coCursos;
    public $coEvaluaciones;
    public $moEmpresas = [];

    public function mount(){
        $this->coEmpresas = Empresa::count();
        $this->coUsuarios = User::count();
        $this->coCursos = Curso::count();
        $this->coEvaluaciones = Evaluacion::count();
        $this->moEmpresas = Empresa::orderBy('razon_social')->get();
    }

    public function render(){
        return view('livewire.dash.dashboard-component')->layout('dash.main');
    }

}
