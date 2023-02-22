<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLocalsTable extends Migration
{
    public function up()
    {
        Schema::table('locals', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7255560')->references('id')->on('users');
            $table->unsignedBigInteger('propertytype_id')->nullable();
            $table->foreign('propertytype_id', 'propertytype_fk_7255561')->references('id')->on('property_types');
            $table->unsignedBigInteger('typeoffer_id')->nullable();
            $table->foreign('typeoffer_id', 'typeoffer_fk_7255562')->references('id')->on('type_offers');
            $table->unsignedBigInteger('setcountry_id')->nullable();
            $table->foreign('setcountry_id', 'setcountry_fk_7255563')->references('id')->on('set_countries');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_7255564')->references('id')->on('cities');
            $table->unsignedBigInteger('quartier_id')->nullable();
            $table->foreign('quartier_id', 'quartier_fk_7255565')->references('id')->on('quartiers');
            $table->unsignedBigInteger('liststatut_id')->nullable();
            $table->foreign('liststatut_id', 'liststatut_fk_7255570')->references('id')->on('list_statuts');
        });
    }
}
