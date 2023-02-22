<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToNeedVehiclesTable extends Migration
{
    public function up()
    {
        Schema::table('need_vehicles', function (Blueprint $table) {
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id', 'brand_fk_7256014')->references('id')->on('brands');
            $table->unsignedBigInteger('modelofvehicle_id')->nullable();
            $table->foreign('modelofvehicle_id', 'modelofvehicle_fk_7256015')->references('id')->on('model_of_vehicles');
            $table->unsignedBigInteger('colortype_id')->nullable();
            $table->foreign('colortype_id', 'colortype_fk_7256016')->references('id')->on('color_types');
            $table->unsignedBigInteger('energytype_id')->nullable();
            $table->foreign('energytype_id', 'energytype_fk_7256017')->references('id')->on('energy_types');
            $table->unsignedBigInteger('gearbox_id')->nullable();
            $table->foreign('gearbox_id', 'gearbox_fk_7256018')->references('id')->on('gear_boxes');
            $table->unsignedBigInteger('vehicletype_id')->nullable();
            $table->foreign('vehicletype_id', 'vehicletype_fk_7256019')->references('id')->on('vehicle_types');
            $table->unsignedBigInteger('typeofutility_id')->nullable();
            $table->foreign('typeofutility_id', 'typeofutility_fk_7256020')->references('id')->on('type_of_utilities');
            $table->unsignedBigInteger('motricitytype_id')->nullable();
            $table->foreign('motricitytype_id', 'motricitytype_fk_7256021')->references('id')->on('motricity_types');
            $table->unsignedBigInteger('typeofwheel_id')->nullable();
            $table->foreign('typeofwheel_id', 'typeofwheel_fk_7256022')->references('id')->on('type_of_wheels');
            $table->unsignedBigInteger('rimtype_id')->nullable();
            $table->foreign('rimtype_id', 'rimtype_fk_7256023')->references('id')->on('rim_types');
            $table->unsignedBigInteger('listofcountry_id')->nullable();
            $table->foreign('listofcountry_id', 'listofcountry_fk_7256024')->references('id')->on('list_of_countries');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7256025')->references('id')->on('users');
            $table->unsignedBigInteger('liststatut_id')->nullable();
            $table->foreign('liststatut_id', 'liststatut_fk_7256026')->references('id')->on('list_statuts');
            $table->unsignedBigInteger('typeoffer_id')->nullable();
            $table->foreign('typeoffer_id', 'typeoffer_fk_7256027')->references('id')->on('type_offers');
            $table->unsignedBigInteger('emergencylevel_id')->nullable();
            $table->foreign('emergencylevel_id', 'emergencylevel_fk_7256032')->references('id')->on('emergency_levels');
        });
    }
}
