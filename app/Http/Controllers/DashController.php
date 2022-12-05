<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use PDF;

use App\Models\Rol;
use App\Models\Empresa;
use App\Models\Evaluacion;


class DashController extends Controller{
    
    public function changeRol(Rol $rol){

        session(['rol' => $rol]);

        switch($rol->id) {
            case 1:
                return redirect()->route('dashboard');
            break;
            case 2:
                return redirect()->route('empresas.dashboard.index', session('empresa'));
            break;
            case 3:
                return redirect()->route('empresas.dashboard.index', session('empresa'));
            break;
            case 4:
                return redirect()->route('alumno.cursos.index');
            break;
        }
        
    }

    public function changeEmpresa(Empresa $empresa){

        $rol = Auth::user()->roles()->wherePivot('empresa_id', $empresa->id)->orderBy('id')->first();
        session(['rol' => $rol]);
        session(['empresa' => $empresa]);
        
        switch($rol->id) {
            case 1:
                return redirect()->route('dashboard');
            break;
            case 2:
                return redirect()->route('empresas.dashboard.index', $empresa);
            break;
            case 3:
                return redirect()->route('empresas.dashboard.index', $empresa);
            break;
            case 4:
                return redirect()->route('alumno.cursos.index');
            break;
        }
        
    }

    
    public function generarCertificado($eid){
        $evaluacion = Evaluacion::find($eid);
        $empresa = Empresa::find($evaluacion->empresa_id);
        $certificado = PDF::loadView('dash.certificado', ['evaluacion' => $evaluacion, 'empresa' => $empresa]);
        $certificado->setPaper('A4', 'landscape');
        return $certificado->download('certificado-'.Str::slug($evaluacion->examen->curso->nombre, '-').'.pdf');
    }

}
