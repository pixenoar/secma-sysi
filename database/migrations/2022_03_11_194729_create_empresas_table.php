<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration{

    public function up(){
        Schema::create('empresas', function (Blueprint $table) {
            $table->id();
            $table->string('razon_social');
            $table->unsignedBigInteger('cuit');
            $table->string('direccion');
            $table->string('telefono');
            $table->string('logo')->nullable();
            $table->unsignedSmallInteger('cupo_user');
            $table->unsignedSmallInteger('costo_user');
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(){
        Schema::dropIfExists('empresas');
    }

}
