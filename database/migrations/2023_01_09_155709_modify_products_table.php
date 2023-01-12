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
        //Creamos el campo que se nos ha olvidado al hacer la tabla. Digamos que modificamos la original. Schema::table para ello
        Schema::table("products", function(Blueprint $table){
            $table->text("descripcion")->after("nombre"); //String lo crea con varchar 255. Con text caben mas caracteres
            //Le decimos con after que la añada despues de nombre
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    //Siempre que creemos algo tiene que tener su contrapartida, eliminar. Con lo que si añadimos algo para crear, añadimos algo para deshacer
    public function down()
    {
        Schema::table("products", function(Blueprint $table){
            $table->dropColumn("descripcion"); //Si no le ponemos ->nullable todas las columnas seran not null (obligatorias)
        }); 
    }
};
