<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Curso;

class Empresa extends Model{

    use HasFactory;

    public $organigrama;


    // ----------

    public function usuarios(){
        return $this->belongsToMany(User::class, 'user_empresa')->withPivot('puesto_id', 'clon')->withTimestamps();
    }

    public function sectores(){
        return $this->hasMany(Sector::class);
    }    

    public function profesores(){
        return $this->hasMany(Profesor::class);
    }
    
    public function cursos(){
        return $this->hasMany(Curso::class)->where('vigente', 1);
    }

    public function planes(){
        return $this->hasMany(Plan::class);
    }
    
    public function evaluaciones(){
        return $this->hasMany(Evaluacion::class);
    } 

    // ----------

    public function cursosAll(){
        return Curso::whereIn('empresa_id', [1, $this->id])->orderBy('id', 'desc')->orderBy('nombre')->get();
    }
    
    public function getOrganigrama($sectorId){

        $this->organigrama = $this->sectores->where('id', $sectorId);
        $this->createOrganigrama($sectorId);
        
        return $this->organigrama;

    }

    public function createOrganigrama($inicio){

        $sectores = $this->sectores->where('padre_id', $inicio)->sortBy('nombre');
        foreach($sectores as $sector){
            $this->organigrama->push($sector);
            $this->createOrganigrama($sector->id);
        }

    }
    
    public function cumplimiento(){

        $aprobados = 0;
        $total = 0;
        $cumplimiento = 0;

        foreach($this->planes as $plan){
            $usuarios = $this->usuarios()->wherePivotIn('sector_id', $this->getOrganigrama( session('rol')->id == 3 ? session('sector')->id : 0 )->modelKeys())->wherePivot('puesto_id', $plan->puesto_id)->get();
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
