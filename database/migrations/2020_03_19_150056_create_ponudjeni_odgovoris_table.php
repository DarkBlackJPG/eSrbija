<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePonudjeniOdgovorisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ponudjeni_odgovoris', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('tekst');
            $table->unsignedBigInteger('pitanja_id');
            $table->timestamps();

            $table->foreign('pitanja_id')
                ->references('id')
                ->on('pitanjas')
                ->onDelete('cascade');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ponudjeni_odgovoris');

        Schema::disableForeignKeyConstraints();
    }
}
