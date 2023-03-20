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
        Schema::create('release_goods', function (Blueprint $table) {
            $table->comment('');
            $table->bigIncrements('id');
            $table->date('date_sorti_prevu');
            $table->longText('conditions_bailleur');
            $table->longText('commentaires')->nullable();
            $table->integer('nb_chambre');
            $table->longText('localisation');
            $table->string('geolocalisation')->nullable();
            $table->date('date_limite')->nullable();
            $table->string('contact_bailleur');
            $table->string('accord_bailleur')->nullable();
            $table->string('libelle')->nullable();
            $table->string('verif_accord_bailleur')->nullable();
            $table->integer('cout');
            $table->string('loyer_augmentera');
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('propertytype_id')->nullable();
            $table->unsignedBigInteger('setcountry_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('quartier_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('liststatut_id')->nullable();
            $table->unsignedBigInteger('emergencylevel_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('release_goods');
    }
};
