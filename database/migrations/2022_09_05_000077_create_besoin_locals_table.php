<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBesoinLocalsTable extends Migration
{
    public function up()
    {
        Schema::create('besoin_locals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nb_chambre');
            $table->longText('localisation');
            $table->string('geolocalisation')->nullable();
            $table->longText('condition_location')->nullable();
            $table->longText('condition_vente')->nullable();
            $table->longText('description')->nullable();
            $table->string('libelle')->unique();
            $table->date('date_limite_demande')->nullable();
            $table->integer('budget_max_achat')->nullable();
            $table->integer('budget_max_location')->nullable();
            $table->string('satisfait')->nullable();
            $table->date('date_satisfait')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
