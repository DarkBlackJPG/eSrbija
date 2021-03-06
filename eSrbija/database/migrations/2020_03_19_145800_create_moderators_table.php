<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModeratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('moderators', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->foreign('id')
                ->references('id')
                ->on('korisniks')
                ->onDelete('cascade');
            $table->primary('id');
            $table->boolean('approved')->default(false);
            $table->string('naziv')->unique();
            $table->string('adresa');
            $table->boolean('adminNotified')->default(false);
            $table->string('pib', 9)->unique();
            $table->string('maticniBroj', 8)->unique();
            $table->smallInteger('lokalnost')->default(1);
            $table->smallInteger('ankete')->default(1);
            $table->unsignedBigInteger('opstinaPoslovanja_id');
            /**===================================*/
            $table->timestamps();
            /**===================================*/
            $table->foreign('opstinaPoslovanja_id')
                ->references('id')
                ->on('mestos')
                ->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('moderators');
    }
}
