<?php

namespace App\Http\Livewire\Dash;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use PDF;

use App\Models\Evaluacion;


class AlumnoExamenesComponent extends Component{

    public function render(){
        return view('livewire.dash.alumno-examenes-component',[
            'evaluaciones' => Auth::user()->evaluaciones()->where('empresa_id', session('empresa')->id)->orderBy('updated_at', 'desc')->get()
        ])->layout('dash.main');
    }

}