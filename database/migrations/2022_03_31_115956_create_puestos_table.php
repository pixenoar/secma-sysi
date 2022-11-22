<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePuestosTable extends Migration{

    public function up(){
        Schema::create('puestos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sector_id');
            $table->string('nombre');
            $table->timestamps();
            // FKs
            $table->foreign('sector_id')->references('id')->on('sectors');
        });
    }

      public function down(){
        Schema::dropIfExists('puestos');
    }

}
