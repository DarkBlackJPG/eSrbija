<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKategorijeObavestenjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
          Schema::create('kategorije_obavestenjas', function (Blueprint $table){
            $table->unsignedBigInteger('obavestenja_id');
            $table->unsignedBigInteger('kategorije_id');
            $table->unique(['obavestenja_id', 'kategorije_id']);
            $table->primary(['obavestenja_id', 'kategorije_id']);
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
        Schema::dropIfExists('kategorije_obavestenjas');
    }
}
