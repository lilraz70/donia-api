<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeedVehiclesTable extends Migration
{
    public function up()
    {
        Schema::create('need_vehicles', function (Blueprint $table) {
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
            $table->integer('budget_max_achat')->nullable();
            $table->integer('budget_max_location')->nullable();
            $table->string('description')->nullable();
            $table->string('libelle')->unique();
            $table->date('date_limite_demande')->nullable();
            $table->string('satisfait')->nullable();
            $table->date('date_satisfait')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
