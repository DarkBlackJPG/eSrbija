<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateZahteviModeratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('zahtevi_moderators', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('e-mail')->unique(); // Treba da se proverava u tabeli za moderatore da li postoji
                                                        // mejl, ovde se stalno brise
            $table->string('password');
            $table->string('naziv')->unique();
            $table->string('adresa');
            $table->string('pib', 9)->unique();// Treba da se proverava u tabeli za moderatore da li postoji
                                                              // pib, ovde se stalno brise
            $table->string('maticniBroj', 8)->unique();
            // Treba da se proverava u tabeli za moderatore da li postoji
            // maticniBroj, ovde se stalno brise
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
        Schema::dropIfExists('zahtevi_moderators');
    }
}
