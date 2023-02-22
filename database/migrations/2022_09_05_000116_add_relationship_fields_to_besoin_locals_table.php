<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBesoinLocalsTable extends Migration
{
    public function up()
    {
        Schema::table('besoin_locals', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7256091')->references('id')->on('users');
            $table->unsignedBigInteger('propertytype_id')->nullable();
            $table->foreign('propertytype_id', 'propertytype_fk_7256092')->references('id')->on('property_types');
            $table->unsignedBigInteger('typeoffer_id')->nullable();
            $table->foreign('typeoffer_id', 'typeoffer_fk_7256093')->references('id')->on('type_offers');
            $table->unsignedBigInteger('setcountry_id')->nullable();
            $table->foreign('setcountry_id', 'setcountry_fk_7256094')->references('id')->on('set_countries');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_7256095')->references('id')->on('cities');
            $table->unsignedBigInteger('quartier_id')->nullable();
            $table->foreign('quartier_id', 'quartier_fk_7256096')->references('id')->on('quartiers');
            $table->unsignedBigInteger('liststatut_id')->nullable();
            $table->foreign('liststatut_id', 'liststatut_fk_7256099')->references('id')->on('list_statuts');
            $table->unsignedBigInteger('emergencylevel_id')->nullable();
            $table->foreign('emergencylevel_id', 'emergencylevel_fk_7256105')->references('id')->on('emergency_levels');
        });
    }
}
