<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMaterialsTable extends Migration{

    public function up(){
        Schema::create('materials', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('curso_id');
            $table->char('tipo', 1);
            $table->string('nombre');
            $table->string('url')->nullable();
            $table->timestamps();
            // FKs
            $table->foreign('curso_id')->references('id')->on('cursos');
        });
    }

    public function down(){
        Schema::dropIfExists('materials');
    }

}
