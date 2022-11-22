<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Puesto extends Model{

    use HasFactory;

    // ----------

    public function sector(){
        return $this->belongsTo(Sector::class);
    }

    public function planes(){
        return $this->hasMany(Plan::class);
    }    

    // ----------



}
