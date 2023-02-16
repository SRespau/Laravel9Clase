<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hairdressers', function (Blueprint $table) {
            $table->id();
            $table->string('NIF',9);
            $table->string('nombre',50);
            $table->string('razon_social');
            $table->string('direccion',200);
            $table->string('email',100);
            $table->string('telefono');
            $table->string('unisex');
            $table->integer('maximo_personas');
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hairdressers');
    }
};
