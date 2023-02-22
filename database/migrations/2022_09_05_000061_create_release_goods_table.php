<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReleaseGoodsTable extends Migration
{
    public function up()
    {
        Schema::create('release_goods', function (Blueprint $table) {
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
            $table->string('verif_accord_bailleur')->nullable();
            $table->string('libelle')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
