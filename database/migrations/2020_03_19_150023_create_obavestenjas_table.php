<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObavestenjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('obavestenjas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('naslov');
            $table->text('opis');
            $table->string('link');
            $table->smallInteger('nivoLokNac');
            $table->unsignedBigInteger('korisnik_id');
            $table->boolean('obrisano');
            $table->timestamps();

            $table->foreign('korisnik_id')
                ->references('id')
                ->on('korisniks')
                ->onDelete('cascade');
        });
        Schema::create('kategorije_obavestenja', function (Blueprint $table){
            $table->unsignedBigInteger('obavestenja_id');
            $table->unsignedBigInteger('kategorije_id');
            $table->unique(['obavestenja_id', 'kategorije_id']);

            $table->foreign('obavestenja_id')
                ->references('id')
                ->on('obavestenjas')
                ->onDelete('cascade');

            $table->foreign('kategorije_id')
                ->references('id')
                ->on('kategorijes')
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
        Schema::dropIfExists('obavestenjas');
    }
}
