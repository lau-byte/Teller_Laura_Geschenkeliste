<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('geschenkelistes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('geschenk', 100); //maximale Anzeichen bei der Benennung des Geschenks: 100
            $table->mediumText('beschreibung')->nullable(); //Beschreibung ist optional und muss nicht ausgefüllt werden
            $table->boolean('besorgt')->default(false); //Ist das Geschenk schon besorgt oder nicht? Standardmäßig ist der Wert 'false', weil erst mal kein Geschenk besorgt wurde
            $table->unsignedInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geschenkelistes');
    }
};
