<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlansTable extends Migration{

    public function up(){
        Schema::create('plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('puesto_id');
            $table->unsignedBigInteger('curso_id');
            $table->unsignedSmallInteger('frecuencia');
            $table->timestamps();
            // FKs
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('curso_id')->references('id')->on('cursos');
            $table->foreign('puesto_id')->references('id')->on('puestos');
        });
    }

    public function down(){
        Schema::dropIfExists('plans');
    }

}
