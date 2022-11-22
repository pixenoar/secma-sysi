<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCursosTable extends Migration{

    public function up(){

        Schema::disableForeignKeyConstraints();
        
        Schema::create('cursos', function(Blueprint $table){
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('categoria_id');
            $table->unsignedBigInteger('profesor_id');
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('autor');
            $table->unsignedSmallInteger('horas');
            $table->string('imagen');
            $table->boolean('estado')->default(0);
            $table->timestamps();
            // FKs
            $table->foreign('empresa_id')->references('id')->on('empresas');
            $table->foreign('categoria_id')->references('id')->on('categorias');
            $table->foreign('profesor_id')->references('id')->on('profesors');
        });
    }

    public function down(){
        Schema::dropIfExists('cursos');
    }

}
