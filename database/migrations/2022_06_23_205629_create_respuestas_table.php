<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRespuestasTable extends Migration{

    public function up(){
        Schema::create('respuestas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('evaluacion_id');
            $table->unsignedBigInteger('pregunta_id');
            $table->unsignedBigInteger('opcion_id');
            $table->timestamps();
            // FKs
            $table->foreign('evaluacion_id')->references('id')->on('evaluacions');
            $table->foreign('pregunta_id')->references('id')->on('preguntas');
            $table->foreign('opcion_id')->references('id')->on('opcions');
        });
    }

    public function down(){
        Schema::dropIfExists('respuestas');
    }

}
