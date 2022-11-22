<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserRolTable extends Migration{

    public function up(){
        Schema::create('user_rol', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('rol_id');
            $table->unsignedBigInteger('empresa_id'); // extra
            // FKs
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('rol_id')->references('id')->on('rols');
        });
    }

    public function down(){
        Schema::dropIfExists('user_rol');
    }
}
