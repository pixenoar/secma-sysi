<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
Use Carbon\Carbon;

class Plan extends Model{

    use HasFactory;

    public function puesto(){
        return $this->belongsTo(Puesto::class);
    }

    public function curso(){
        return $this->belongsTo(Curso::class);
    }

    public function estado($user_id, $empresa_id){

        $evaluacion = $this->curso->examen->evaluaciones()->where('user_id', $user_id)
                                                          ->where('empresa_id', $empresa_id)
                                                          ->orderBy('updated_at', 'desc')
                                                          ->first();


        if($evaluacion){
            if($evaluacion->estado == 'C'){
                if($evaluacion->nota == 'A'){
                    if( $this->frecuencia && $evaluacion->updated_at->addDays($this->frecuencia)->diffInDays(now()) <= $this->curso->examen->tiempo_anticipacion_rendir){
                        return 'P';
                    }else{
                        return 'V';
                    }
                }else{
                    return 'P';
                }
            }else{
                return 'P';
            }
        }else{
            return 'P';
        }

    }

    public function bloqueado($user_id, $empresa_id){


        $desaprobados = $this->curso->examen->evaluaciones()->where('user_id', $user_id)
                                                            ->where('empresa_id', $empresa_id)
                                                            ->where('estado', 'C')
                                                            ->where('nota', 'D')
                                                            ->whereNull('ignorado')
                                                            ->get();

        $incompletos = $this->curso->examen->evaluaciones()->where('user_id', $user_id)
                                                           ->where('empresa_id', $empresa_id)
                                                           ->where('estado', 'I')
                                                           ->whereNull('ignorado')
                                                           ->get();

        if( $desaprobados->count() >= 2 || $incompletos->count() >= 2 ){
            $bloqueado = true;
        }else{
            $bloqueado = false;
        }

/*
        $desaprobados = $this->curso->examen->evaluaciones()->where('user_id', $user_id)
                                                            ->where('empresa_id', $empresa_id)
                                                            ->where('estado', 'C')
                                                            ->where('nota', 'D')
                                                            ->orderBy('updated_at', 'desc')
                                                            ->count();

        $incompletos = $this->curso->examen->evaluaciones()->where('user_id', $user_id)
                                                            ->where('empresa_id', $empresa_id)
                                                            ->where('estado', 'I')
                                                            ->orderBy('updated_at', 'desc')
                                                            ->count();       */                                             

        return $bloqueado;

    }

    public function frecuencia(){

        if($this->frecuencia){
            return $this->frecuencia;
        }else{
            return 'única vez';
        }

    }

}
