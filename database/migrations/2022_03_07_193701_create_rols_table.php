<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolsTable extends Migration{

    public function up(){
        Schema::create('rols', function (Blueprint $table){
            $table->id();
            $table->string('nombre');
        });
    }

    public function down(){
        Schema::dropIfExists('rols');
    }

}

/*
    1. Administrador
    2. Recursos Humanos
    3. Responsable de Sector
    4. Alumno
*/