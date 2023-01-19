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
        Schema::create('courses_students', function (Blueprint $table) {//en orden alfabetico para que laravel mapee bien los nombres
            $table->id();
            //id foranea profesores
            $table->unsignedBigInteger("student_id"); //Se crea el campo igual que el tipo creado de la id principal de la tabla
            $table->foreign("student_id")->references("id")->on("students");//Establezco enlace de clave foranea referenciando a id de tabla profesor
            //id foranea cursos
            $table->unsignedBigInteger("course_id");
            $table->foreign("course_id")->references("id")->on("courses");
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
        Schema::dropIfExists('courses_students');
    }
};
