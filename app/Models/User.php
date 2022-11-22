<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use App\Models\Puesto;

class User extends Authenticatable implements MustVerifyEmail{

    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'surname',
        'dni',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // métodos relaciones
    
    public function roles(){
        return $this->belongsToMany(Rol::class, 'user_rol');
    }

    public function empresas(){
        return $this->belongsToMany(Empresa::class, 'user_empresa');
    }

    public function puestos(){
        return $this->belongsToMany(Puesto::class, 'user_empresa', 'user_id', 'puesto_id');
    }

    public function evaluaciones(){
        return $this->hasMany(Evaluacion::class);
    }

    // métodos propios

    public function puesto(Empresa $moEmpresa){
        $moUser = $moEmpresa->usuarios()->wherePivot('user_id', $this->id)->first();
        $moPuesto = Puesto::find($moUser->pivot->puesto_id);
        return $moPuesto;
    }


}