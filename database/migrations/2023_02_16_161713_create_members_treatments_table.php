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
        Schema::create('members_treatments', function (Blueprint $table) {
            $table->id();
            $table->date('fecha');

            $table->unsignedBigInteger('member_id');
            $table->foreign('member_id')->references('id')->on('members')->onUpdate("cascade")->onDelete("cascade");;

            $table->unsignedBigInteger('treatment_id');
            $table->foreign('treatment_id')->references('id')->on('treatments')->onUpdate("cascade")->onDelete("cascade");;            

            $table->string('aesthetic_id')->nullable();
            $table->foreign('aesthetic_id')->references('id')->on('aesthetic_centers')->nullable()->onUpdate("cascade")->onDelete("cascade");

            $table->string('hairdresser_id')->nullable();
            $table->foreign('hairdresser_id')->references('id')->on('hairdressers')->nullable()->onUpdate("cascade")->onDelete("cascade");
            
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
        Schema::dropIfExists('members_treatments');
    }
};
