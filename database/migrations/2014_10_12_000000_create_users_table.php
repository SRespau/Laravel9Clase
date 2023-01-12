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
    //Necesitamos un fichero por cada tabla a migrar
    //Crea las tablas
    public function up()
    {
        Schema::create('users', function (Blueprint $table) { //Función anonima a la que se le pasa un objeto Blueprint. Usamos Schema::create
            $table->id();//La creará integer, unsigned(sin signo), autoincremental y primary key
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken(); //Crea un token aleatorio de tipo cadena
            $table->timestamps(); //este comando crea en la tabla dos campos automaticamente -> created_at, updated_at
            //Se puede poner timestamp y crearia un campo timestamp. Para que cree ambos campos ha de ir en mayuscula
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    //Borra las tablas si es necesario
    public function down()
    {
        Schema::dropIfExists('users'); //comando para cuando exista. Puedes poner "drop", no chequea si existe.
    }
};
