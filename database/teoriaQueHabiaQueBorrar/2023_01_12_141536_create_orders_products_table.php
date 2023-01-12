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
    public function up() //RELACION N-N
    {
        //¡¡IMPORTANTE!! QUE AL SER RELACION N - N SE CREA UNA TABLA NUEVA DONDE SE AÑADA AL NOMBRE EL NOMBRE DE AMBAS TABLAS EN ORDEN ALFABETICO
        Schema::create('orders_products', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('order_id');//Crea el campo fk de order
            $table->foreign('order_id')->references('id')->on('orders')->onDelete("cascade"); //Crea la referencia

            $table->unsignedBigInteger('product_id');//Crea el campo fk de product 
            $table->foreign('product_id')->references('id')->on('products')->onDelete("cascade"); //Crea la referencia
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
        Schema::dropIfExists('order_products');
    }
};
