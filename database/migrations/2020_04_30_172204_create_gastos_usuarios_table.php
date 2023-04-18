<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGastosUsuariosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gastos_usuarios', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('usuario');
            $table->bigInteger('convenio');
            $table->decimal('valor', 15,2);
            $table->integer('mesref');
            $table->integer('anoref');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gastos_usuarios');
    }
}
