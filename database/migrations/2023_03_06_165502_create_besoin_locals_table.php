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
        Schema::create('besoin_locals', function (Blueprint $table) {
            $table->comment('');
            $table->unsignedBigInteger('id');
            $table->integer('nb_chambre');
            $table->longText('localisation');
            $table->string('geolocalisation', 255)->nullable();
            $table->longText('condition_location')->nullable();
            $table->longText('condition_vente')->nullable();
            $table->longText('description')->nullable();
            $table->string('libelle', 255);
            $table->date('date_limite_demande')->nullable();
            $table->integer('budget_max_achat')->nullable();
            $table->integer('budget_max_location')->nullable();
            $table->string('satisfait', 255)->nullable();
            $table->date('date_satisfait')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('propertytype_id')->nullable();
            $table->unsignedBigInteger('typeoffer_id')->nullable();
            $table->unsignedBigInteger('setcountry_id')->nullable();
            $table->unsignedBigInteger('city_id')->nullable();
            $table->unsignedBigInteger('quartier_id')->nullable();
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
        Schema::dropIfExists('besoin_locals');
    }
};
