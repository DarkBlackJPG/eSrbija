<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeprivilegovanKorisniksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('neprivilegovan_korisniks', function (Blueprint $table) {
            $table->unsignedBigInteger('id');
            $table->foreign('id')
                ->references('id')
                ->on('korisniks')
                ->onDelete('cascade');
            $table->primary('id');

            $table->string('ime');
            $table->string('prezime');
            $table->date('datumRodjenja');
            $table->string('adresaPrebivalista');
            $table->string('jmbg', 13)->unique();
            $table->boolean('pol');
            $table->string('brojLicneKarte', 9)->unique();
            $table->unsignedBigInteger('opstinaPrebivalista_id');
            $table->unsignedBigInteger('opstinaRodjenja_id');
            /** ======================================================= */
            $table->timestamps();
            /** ======================================================= */
            $table->foreign('opstinaRodjenja_id')
                ->references('id')
                ->on('mestos')
                ->onDelete('cascade');
            $table->foreign('opstinaPrebivalista_id')
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
        Schema::dropIfExists('neprivilegovan_korisniks');
    }
}
