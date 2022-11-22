<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamensTable extends Migration{

    public function up(){
        Schema::create('examens', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('curso_id');
            $table->unsignedTinyInteger('version')->default(1);
            $table->unsignedTinyInteger('porcentaje_aprobacion')->default(80);
            $table->unsignedTinyInteger('tiempo_responder')->default(120);
            $table->unsignedTinyInteger('tiempo_anticipacion_rendir')->default(30);
            $table->timestamps();
            // FKs
            $table->foreign('curso_id')->references('id')->on('cursos');
        });
    }

    public function down(){
        Schema::dropIfExists('examens');
    }

}
