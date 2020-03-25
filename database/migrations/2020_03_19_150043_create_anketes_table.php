<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnketesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anketes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('naziv');
            $table->boolean('obrisanoFlag');
            $table->boolean('isActive');
            $table->integer('nivoLokNac');
            $table->unsignedBigInteger('korisnik_id');
            $table->timestamps();

            $table->foreign('korisnik_id')
                ->references('id')
                ->on('korisniks')
                ->onDelete('cascade');
        });
        Schema::create('ankete_mestos', function (Blueprint $table){
            $table->unsignedBigInteger('ankete_id');
            $table->unsignedBigInteger('mesto_id');
            $table->timestamps();
            $table->unique(['ankete_id', 'mesto_id']);

            $table->foreign('ankete_id')
                ->references('id')
                ->on('anketes')
                ->onDelete('cascade');

            $table->foreign('mesto_id')
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
        Schema::dropIfExists('anketes');
    }
}
