<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Curso extends Model{

    use HasFactory;

    //--------

    public function empresa(){
        return $this->belongsTo(Empresa::class);
    }

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    }

    public function profesor(){
        return $this->belongsTo(Profesor::class);
    }

    public function materiales(){
        return $this->hasMany(Material::class);
    }
    
    public function examen(){
        return $this->hasOne(Examen::class)->orderBy('created_at', 'desc');
    }    

    public function plan(){
        return $this->hasOne(Plan::class);
    }

    //--------

    public function version(){
        return Examen::where('curso_id', $this->id)->count();
    }


}
