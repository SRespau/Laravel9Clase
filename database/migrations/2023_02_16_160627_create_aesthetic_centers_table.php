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
        Schema::create('aesthetic_centers', function (Blueprint $table) {
            $table->id();
            $table->string('NIF',9);
            $table->string('nombre',50);
            $table->string('razon_social');
            $table->string('direccion',200);
            $table->string('email',100);
            $table->string('telefono');
            $table->string('servicio_fisio');
            $table->integer('num_salas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aesthetic_centers');
    }
};
