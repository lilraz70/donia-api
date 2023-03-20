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
        Schema::create('carpooling_vehicles', function (Blueprint $table) {
            $table->comment('');
            $table->unsignedBigInteger('id');
            $table->string('finition', 255);
            $table->integer('nb_place');
            $table->string('annee_fabrication', 255);
            $table->string('conso_au_100_km', 255);
            $table->integer('nb_chevaux');
            $table->integer('nb_cylindre')->nullable();
            $table->string('accessoires', 255)->nullable();
            $table->integer('kilometrage');
            $table->string('options', 255);
            $table->string('pannes_signalees', 255);
            $table->string('immatriculation', 255);
            $table->string('libelle', 255);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->unsignedBigInteger('modelofvehicle_id')->nullable();
            $table->unsignedBigInteger('colortype_id')->nullable();
            $table->unsignedBigInteger('energytype_id')->nullable();
            $table->unsignedBigInteger('gearbox_id')->nullable();
            $table->unsignedBigInteger('vehicletype_id')->nullable();
            $table->unsignedBigInteger('motricitytype_id')->nullable();
            $table->unsignedBigInteger('typeofwheel_id')->nullable();
            $table->unsignedBigInteger('rimtype_id')->nullable();
            $table->unsignedBigInteger('listofcountry_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('liststatut_id')->nullable();
            $table->unsignedBigInteger('typeofutility_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carpooling_vehicles');
    }
};
