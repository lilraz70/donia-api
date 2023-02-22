<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLodgingsTable extends Migration
{
    public function up()
    {
        Schema::create('lodgings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nb_chambre');
            $table->integer('prix_journalier')->nullable();
            $table->integer('prix_mensuel')->nullable();
            $table->longText('localisation');
            $table->string('geolocalisation')->nullable();
            $table->string('libelle')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
