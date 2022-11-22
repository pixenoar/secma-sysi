<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sector extends Model{

    use HasFactory;

    // ----------------

    public function puestos(){
        return $this->hasMany(Puesto::class);
    }

    // ----------------

    public function usuarios(Empresa $moEmpresa){
        return $moEmpresa->usuarios()->wherePivot('sector_id', $this->id)->count();
    }

    public function evaluaciones(Empresa $moEmpresa){
        return $moEmpresa->evaluaciones()->whereIn('user_id', $moEmpresa->usuarios()->wherePivot('sector_id', $this->id)->get()->modelKeys())->count();
    }

    public function cumplimiento(Empresa $moEmpresa){

        $aprobados = 0;
        $total = 0;
        $cumplimiento = 0;

        foreach($moEmpresa->planes as $plan){
            $usuarios = $moEmpresa->usuarios()->wherePivot('sector_id', $this->id)->wherePivot('puesto_id', $plan->puesto_id)->get();
            $total = $total + $usuarios->count();
            foreach($usuarios as $usuario){
                $aprobados = $aprobados + $usuario->evaluaciones->where('examen_id', $plan->curso->examen->id)->where('nota', 'A')->count();
            }
        }
        
        if($total){
            $cumplimiento = round(($aprobados*100)/$total);
        }
        
        return $cumplimiento;
    
    }

    
    
}
