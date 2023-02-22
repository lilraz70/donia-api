<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToSellRentCarsTable extends Migration
{
    public function up()
    {
        Schema::table('sell_rent_cars', function (Blueprint $table) {
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id', 'brand_fk_7255965')->references('id')->on('brands');
            $table->unsignedBigInteger('modelofvehicle_id')->nullable();
            $table->foreign('modelofvehicle_id', 'modelofvehicle_fk_7255966')->references('id')->on('model_of_vehicles');
            $table->unsignedBigInteger('colortype_id')->nullable();
            $table->foreign('colortype_id', 'colortype_fk_7255967')->references('id')->on('color_types');
            $table->unsignedBigInteger('energytype_id')->nullable();
            $table->foreign('energytype_id', 'energytype_fk_7255968')->references('id')->on('energy_types');
            $table->unsignedBigInteger('gearbox_id')->nullable();
            $table->foreign('gearbox_id', 'gearbox_fk_7255969')->references('id')->on('gear_boxes');
            $table->unsignedBigInteger('vehicletype_id')->nullable();
            $table->foreign('vehicletype_id', 'vehicletype_fk_7255970')->references('id')->on('vehicle_types');
            $table->unsignedBigInteger('typeofutility_id')->nullable();
            $table->foreign('typeofutility_id', 'typeofutility_fk_7255971')->references('id')->on('type_of_utilities');
            $table->unsignedBigInteger('motricitytype_id')->nullable();
            $table->foreign('motricitytype_id', 'motricitytype_fk_7255972')->references('id')->on('motricity_types');
            $table->unsignedBigInteger('typeofwheel_id')->nullable();
            $table->foreign('typeofwheel_id', 'typeofwheel_fk_7255973')->references('id')->on('type_of_wheels');
            $table->unsignedBigInteger('rimtype_id')->nullable();
            $table->foreign('rimtype_id', 'rimtype_fk_7255974')->references('id')->on('rim_types');
            $table->unsignedBigInteger('listofcountry_id')->nullable();
            $table->foreign('listofcountry_id', 'listofcountry_fk_7255975')->references('id')->on('list_of_countries');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7255976')->references('id')->on('users');
            $table->unsignedBigInteger('liststatut_id')->nullable();
            $table->foreign('liststatut_id', 'liststatut_fk_7255977')->references('id')->on('list_statuts');
            $table->unsignedBigInteger('typeoffer_id')->nullable();
            $table->foreign('typeoffer_id', 'typeoffer_fk_7255978')->references('id')->on('type_offers');
        });
    }
}
