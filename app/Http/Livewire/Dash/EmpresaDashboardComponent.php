<?php

namespace App\Http\Livewire\Dash;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

use App\Models\Empresa;

class EmpresaDashboardComponent extends Component{

    public $moEmpresa;
    public $coUsuarios = 0;
    public $coEvaluaciones = 0;
    public $poCumplimiento = 0;

    // ----------------

    public function mount(Empresa $moEmpresa){
        $this->moEmpresa = $moEmpresa;
        $this->coUsuarios = $this->moEmpresa->usuarios()->wherePivotIn('sector_id', $moEmpresa->getOrganigrama(session('rol')->id == 3 ? session('sector')->id : 0)->modelKeys())->count(); 
        $this->coEvaluaciones = $this->moEmpresa->evaluaciones()->whereIn('user_id', $this->moEmpresa->usuarios()->wherePivotIn('sector_id', $moEmpresa->getOrganigrama(session('rol')->id == 3 ? session('sector')->id : 0)->modelKeys())->get()->modelKeys())->count();
        $this->poCumplimiento = $this->moEmpresa->cumplimiento();
    }

    // ----------------

    public function render(){
        return view('livewire.dash.empresa-dashboard-component')->layout('dash.main');
    }

}
