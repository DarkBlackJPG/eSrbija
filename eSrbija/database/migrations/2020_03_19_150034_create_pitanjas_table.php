<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePitanjasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pitanjas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('tekst');
            $table->unsignedBigInteger('ankete_id');
            $table->timestamps();

            $table->foreign('ankete_id')
                ->references('id')
                ->on('anketes')
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
        Schema::dropIfExists('pitanjas');
    }
}
