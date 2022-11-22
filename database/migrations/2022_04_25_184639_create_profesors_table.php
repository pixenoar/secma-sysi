<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfesorsTable extends Migration{

    public function up(){
        Schema::create('profesors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->string('nombre');
            $table->string('apellido');
            $table->unsignedInteger('dni');
            $table->string('titulo');
            $table->string('matricula');
            $table->string('email');
            $table->string('telefono');
            $table->string('firma')->nullable();
            $table->boolean('estado')->default(1);
            $table->timestamps();
            // FKs
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }

    public function down(){
        Schema::dropIfExists('profesors');
    }

}
