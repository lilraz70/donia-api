<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLandsTable extends Migration
{
    public function up()
    {
        Schema::table('lands', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7255579')->references('id')->on('users');
            $table->unsignedBigInteger('propertytype_id')->nullable();
            $table->foreign('propertytype_id', 'propertytype_fk_7255580')->references('id')->on('property_types');
            $table->unsignedBigInteger('typeoffer_id')->nullable();
            $table->foreign('typeoffer_id', 'typeoffer_fk_7255581')->references('id')->on('type_offers');
            $table->unsignedBigInteger('setcountry_id')->nullable();
            $table->foreign('setcountry_id', 'setcountry_fk_7255582')->references('id')->on('set_countries');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_7255583')->references('id')->on('cities');
            $table->unsignedBigInteger('quartier_id')->nullable();
            $table->foreign('quartier_id', 'quartier_fk_7255584')->references('id')->on('quartiers');
            $table->unsignedBigInteger('liststatut_id')->nullable();
            $table->foreign('liststatut_id', 'liststatut_fk_7255589')->references('id')->on('list_statuts');
            $table->unsignedBigInteger('landcategory_id')->nullable();
            $table->foreign('landcategory_id', 'landcategory_fk_7255591')->references('id')->on('land_categories');
        });
    }
}
