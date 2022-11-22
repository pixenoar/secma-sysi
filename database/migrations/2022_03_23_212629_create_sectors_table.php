<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectorsTable extends Migration{

    public function up(){
        Schema::create('sectors', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('padre_id');
            $table->string('nombre');
            $table->timestamps();
            // FKs
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }

    public function down(){
        Schema::dropIfExists('sectors');
    }

}
