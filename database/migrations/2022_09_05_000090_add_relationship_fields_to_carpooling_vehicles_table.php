<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCarpoolingVehiclesTable extends Migration
{
    public function up()
    {
        Schema::table('carpooling_vehicles', function (Blueprint $table) {
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id', 'brand_fk_7253759')->references('id')->on('brands');
            $table->unsignedBigInteger('modelofvehicle_id')->nullable();
            $table->foreign('modelofvehicle_id', 'modelofvehicle_fk_7253838')->references('id')->on('model_of_vehicles');
            $table->unsignedBigInteger('colortype_id')->nullable();
            $table->foreign('colortype_id', 'colortype_fk_7253839')->references('id')->on('color_types');
            $table->unsignedBigInteger('energytype_id')->nullable();
            $table->foreign('energytype_id', 'energytype_fk_7253970')->references('id')->on('energy_types');
            $table->unsignedBigInteger('gearbox_id')->nullable();
            $table->foreign('gearbox_id', 'gearbox_fk_7253840')->references('id')->on('gear_boxes');
            $table->unsignedBigInteger('vehicletype_id')->nullable();
            $table->foreign('vehicletype_id', 'vehicletype_fk_7253971')->references('id')->on('vehicle_types');
            $table->unsignedBigInteger('motricitytype_id')->nullable();
            $table->foreign('motricitytype_id', 'motricitytype_fk_7254260')->references('id')->on('motricity_types');
            $table->unsignedBigInteger('typeofwheel_id')->nullable();
            $table->foreign('typeofwheel_id', 'typeofwheel_fk_7254261')->references('id')->on('type_of_wheels');
            $table->unsignedBigInteger('rimtype_id')->nullable();
            $table->foreign('rimtype_id', 'rimtype_fk_7254262')->references('id')->on('rim_types');
            $table->unsignedBigInteger('listofcountry_id')->nullable();
            $table->foreign('listofcountry_id', 'listofcountry_fk_7254263')->references('id')->on('list_of_countries');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7254264')->references('id')->on('users');
            $table->unsignedBigInteger('liststatut_id')->nullable();
            $table->foreign('liststatut_id', 'liststatut_fk_7254265')->references('id')->on('list_statuts');
            $table->unsignedBigInteger('typeofutility_id')->nullable();
            $table->foreign('typeofutility_id', 'typeofutility_fk_7255985')->references('id')->on('type_of_utilities');
        });
    }
}
