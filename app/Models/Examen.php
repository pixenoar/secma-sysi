<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Examen extends Model{

    use HasFactory;

    public function preguntas(){
        return $this->hasMany(Pregunta::class);
    }

    public function curso(){
        return $this->belongsTo(Curso::class);
    }

    public function evaluaciones(){
        return $this->hasMany(Evaluacion::class);
    }

}
