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
        Schema::create('aesthetic_hairdresser_treatment', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger(('aesthetic_id'));
            $table->foreign('aesthetic_id')->references('id')->on('aesthetic_centers');

            $table->unsignedBigInteger(('hairdresser_id'));
            $table->foreign('hairdresser_id')->references('id')->on('hairdressers');

            $table->unsignedBigInteger(('treatment_id'));
            $table->foreign('treatment_id')->references('id')->on('treatments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aesthetic_hairdresser_treatment');
    }
};
