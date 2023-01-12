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
    public function up() //CREACION TABLA 1-N  (PARA 1-1 CUALQUIER CLAVE SERIA LA AJENA DE LA OTRA TABLA, NO IMPORTA CUAL PONGAS DONDE)
    {
        //ESTOS CAMBIOS SERIAN PARA UNA RELACION 1 - N. UN PEDIDO TIENE VARIOS PRODUCTOS
        Schema::table('products', function (Blueprint $table) {

            $table->unsignedBigInteger('order_id');//Crea el campo fk. 
            //Le ponemos unsignedBigInteger porque laravel crea la id automaticamente asi y tenemos que referenciarla del mismo tipo
 
            $table->foreign('order_id')->references('id')->on('orders')->onDelete("cascade"); //Crea la referencia

        });
        /*Lo mismo de arriba puede acortarse a:
            Schema::table('products', function (Blueprint $table) {

            $table->foreignId('order_id')->constrained(); //Cualquier modificador adicional en este modo tiene que ir siempre antes que el constrained. El ->constrained siempre lo último

            });
        */
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() //Siempre hay que hacer lo contrario al up. En este caso borrar la clave foranea
    {
        Schema::table('products', function (Blueprint $table) {

            //$table->dropForeign('products_order_id_foreign'); Una forma de borrar la clave foranea. ("tabla_columna_foreign)
            $table->dropForeign(['order_id']);// 2º forma para borrar la referencia. Se añade una array. El campo no lo borra, hay que poner otra linea de dropColumn
            $table->dropColumn("order_id");// Para borrar el campo
        });        
    }
};
