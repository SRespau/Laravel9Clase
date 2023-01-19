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
        Schema::table("courses", function(Blueprint $table){
            $table->unsignedBigInteger("teacher_id");
            $table->foreign("teacher_id")->references("id")->on("teachers");

            //Tambien podemos usar
            //$table->foreignId('teacher_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table("courses", function(Blueprint $table){
            $table->dropForeign(["teacher_id"]);
            $table->dropColumn("teacher_id");
        });
    }
};
