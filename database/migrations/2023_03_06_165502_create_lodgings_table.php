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
        Schema::create('lodgings', function (Blueprint $table) {
            $table->comment('');
            $table->unsignedBigInteger('id');
            $table->integer('nb_chambre');
            $table->integer('prix_journalier')->nullable();
            $table->integer('prix_mensuel')->nullable();
            $table->longText('localisation');
            $table->string('geolocalisation', 255)->nullable();
            $table->string('libelle', 255);
            $table->string('description', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('hostingtype_id')->nullable();
            $table->unsignedBigInteger('typeofhouse_id')->nullable();
            $table->unsignedBigInteger('setcountry_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('quartier_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('liststatut_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lodgings');
    }
};
