<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEmpresaTable extends Migration{

    public function up(){
        Schema::create('user_empresa', function (Blueprint $table){
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('empresa_id');
            $table->unsignedBigInteger('sector_id');
            $table->unsignedBigInteger('puesto_id');
            $table->boolean('clon')->default(0);
            $table->timestamps();
            // FKs
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('empresa_id')->references('id')->on('empresas');
        });
    }

    public function down(){
        Schema::dropIfExists('user_empresa');
    }

}
