<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEvaluacionsTable extends Migration{

    public function up(){
        Schema::create('evaluacions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('examen_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('empresa_id');
            $table->char('estado', 1)->default('I');
            $table->char('nota', 1)->nullable();
            $table->unsignedTinyInteger('calificacion')->nullable();
            $table->timestamps();
            // FKs
            $table->foreign('examen_id')->references('id')->on('examens');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }

    public function down(){
        Schema::dropIfExists('evaluacions');
    }

}
