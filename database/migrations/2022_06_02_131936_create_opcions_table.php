<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOpcionsTable extends Migration{

    public function up(){
        Schema::create('opcions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pregunta_id');
            $table->char('tipo', 1)->default('T');
            $table->string('descripcion');
            $table->boolean('correcta')->nullable();
            $table->unsignedTinyInteger('orden');
            $table->timestamps();
            // FKs
            $table->foreign('pregunta_id')->references('id')->on('preguntas')->onDelete('cascade');
        });
    }

    public function down(){
        Schema::dropIfExists('opcions');
    }

}
