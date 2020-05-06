<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKorisniksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('korisniks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('verification_token')->nullable();
            $table->string('password');
            $table->boolean('isAdmin');
            $table->boolean('isMod');
            /**===========================================**/
            $table->rememberToken();
            $table->timestamps();
            /**===========================================**/
        });
        Schema::create('kategorije_pretplates', function (Blueprint $table){
            $table->unsignedBigInteger('korisnik_id');
            $table->unsignedBigInteger('kategorije_id');
            $table->unique(['korisnik_id', 'kategorije_id']);
            $table->primary(['korisnik_id', 'kategorije_id']);

            $table->foreign('korisnik_id')
                ->references('id')
                ->on('korisniks')
                ->onDelete('cascade');

            $table->foreign('kategorije_id')
                ->references('id')
                ->on('kategorijes')
                ->onDelete('cascade');
        });

        Schema::create('kategorije_ovlascenjas', function (Blueprint $table){
            $table->unsignedBigInteger('korisnik_id');
            $table->unsignedBigInteger('kategorije_id');
            $table->unique(['korisnik_id', 'kategorije_id']);
            $table->primary(['korisnik_id', 'kategorije_id']);
            $table->foreign('korisnik_id')
                ->references('id')
                ->on('korisniks')
                ->onDelete('cascade');

            $table->foreign('kategorije_id')
                ->references('id')
                ->on('kategorijes')
                ->onDelete('cascade');
        });

        Schema::create('odgovori_korisnik', function (Blueprint $table){
            $table->unsignedBigInteger('korisnik_id');
            $table->unsignedBigInteger('ponudjeni_odgovori_id');
            $table->unique(['korisnik_id', 'ponudjeni_odgovori_id']);
            $table->primary(['korisnik_id', 'ponudjeni_odgovori_id']);
            $table->foreign('korisnik_id')
                ->references('id')
                ->on('korisniks')
                ->onDelete('cascade');

            $table->foreign('ponudjeni_odgovori_id')
                ->references('id')
                ->on('ponudjeni_odgovoris')
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
        Schema::dropIfExists('ponudjeni_odgovori_korisnik');
        Schema::dropIfExists('kategorije_korisnik_ovlascenjas');
        Schema::dropIfExists('kategorije_korisnik_pretplates');
        Schema::dropIfExists('korisniks');

    }
}
