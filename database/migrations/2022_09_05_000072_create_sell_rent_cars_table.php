<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellRentCarsTable extends Migration
{
    public function up()
    {
        Schema::create('sell_rent_cars', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('finition');
            $table->integer('nb_place');
            $table->string('annee_fabrication');
            $table->string('conso_au_100_km');
            $table->integer('nb_chevaux');
            $table->integer('nb_cylindre')->nullable();
            $table->string('accessoires')->nullable();
            $table->integer('kilometrage');
            $table->string('options');
            $table->string('pannes_signalees');
            $table->string('immatriculation');
            $table->string('prix_vente')->nullable();
            $table->string('prix_location')->nullable();
            $table->string('description')->nullable();
            $table->string('libelle')->unique();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
