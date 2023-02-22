<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLocalsTable extends Migration
{
    public function up()
    {
        Schema::create('locals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('nb_chambre');
            $table->longText('localisation');
            $table->string('geolocalisation')->nullable();
            $table->integer('prix_vente')->nullable();
            $table->integer('prix_location')->nullable();
            $table->longText('condition_location')->nullable();
            $table->longText('condition_vente')->nullable();
            $table->longText('description')->nullable();
            $table->string('libelle')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
