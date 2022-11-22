<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluacion extends Model{

    use HasFactory;

    public function examen(){
        return $this->belongsTo(Examen::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function respuestas(){
        return $this->hasMany(Respuesta::class);
    }

    //-----

    public function calificacion(){
        if($this->estado == 'C'){
            return $this->calificacion.'%';  
        }
    }

    public function vigencia(){
        if($this->estado == 'C' && $this->nota == 'A'){
            if($this->examen->curso->plan->frecuencia){
                return $this->updated_at->addDays($this->examen->curso->plan->frecuencia)->format('d/m/Y');
            }else{
                return 'no caduca';
            }  
        }
    }

}
