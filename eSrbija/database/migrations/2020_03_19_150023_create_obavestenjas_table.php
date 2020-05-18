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
            $table->string('link')->nullable();
            $table->smallInteger('nivoLokNac');
            $table->unsignedBigInteger('korisnik_id');
            $table->boolean('obrisanoFlag')->default(false);
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
        Schema::dropIfExists('obavestenjas');
    }
}
