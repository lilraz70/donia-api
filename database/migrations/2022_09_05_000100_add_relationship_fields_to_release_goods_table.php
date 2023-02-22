<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReleaseGoodsTable extends Migration
{
    public function up()
    {
        Schema::table('release_goods', function (Blueprint $table) {
            $table->unsignedBigInteger('propertytype_id')->nullable();
            $table->foreign('propertytype_id', 'propertytype_fk_7255540')->references('id')->on('property_types');
            $table->unsignedBigInteger('setcountry_id')->nullable();
            $table->foreign('setcountry_id', 'setcountry_fk_7255541')->references('id')->on('set_countries');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_7255542')->references('id')->on('cities');
            $table->unsignedBigInteger('quartier_id')->nullable();
            $table->foreign('quartier_id', 'quartier_fk_7255543')->references('id')->on('quartiers');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7255544')->references('id')->on('users');
            $table->unsignedBigInteger('liststatut_id')->nullable();
            $table->foreign('liststatut_id', 'liststatut_fk_7255545')->references('id')->on('list_statuts');
            $table->unsignedBigInteger('emergencylevel_id')->nullable();
            $table->foreign('emergencylevel_id', 'emergencylevel_fk_7255546')->references('id')->on('emergency_levels');
        });
    }
}
