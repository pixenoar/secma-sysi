<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePreguntasTable extends Migration{

    public function up(){
        Schema::create('preguntas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('examen_id');
            $table->string('descripcion');
            $table->boolean('excluyente')->nullable();
            $table->unsignedTinyInteger('orden');
            $table->timestamps();
            // FKs
            $table->foreign('examen_id')->references('id')->on('examens');
        });
    }

    public function down(){
        Schema::dropIfExists('preguntas');
    }

}
