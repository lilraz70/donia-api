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
        Schema::create('locals', function (Blueprint $table) {
            $table->comment('');
            $table->unsignedBigInteger('id');
            $table->integer('nb_chambre');
            $table->longText('localisation');
            $table->string('geolocalisation', 255)->nullable();
            $table->integer('prix_vente')->nullable();
            $table->integer('prix_location')->nullable();
            $table->longText('condition_location')->nullable();
            $table->longText('condition_vente')->nullable();
            $table->longText('description')->nullable();
            $table->string('libelle', 255);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('propertytype_id')->nullable();
            $table->unsignedBigInteger('typeoffer_id')->nullable();
            $table->unsignedBigInteger('setcountry_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('quartier_id')->nullable();
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
        Schema::dropIfExists('locals');
    }
};
