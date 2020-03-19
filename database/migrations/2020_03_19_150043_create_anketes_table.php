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
            $table->integer('nivoLokNac');
            $table->unsignedBigInteger('korisnik_id');
            $table->timestamps();

            $table->foreign('korisnik_id')
                ->references('id')
                ->on('korisniks')
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
