<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToBesoinHebergementsTable extends Migration
{
    public function up()
    {
        Schema::table('besoin_hebergements', function (Blueprint $table) {
            $table->unsignedBigInteger('hostingtype_id')->nullable();
            $table->foreign('hostingtype_id', 'hostingtype_fk_7256045')->references('id')->on('hosting_types');
            $table->unsignedBigInteger('typeofhouse_id')->nullable();
            $table->foreign('typeofhouse_id', 'typeofhouse_fk_7256046')->references('id')->on('type_of_houses');
            $table->unsignedBigInteger('setcountry_id')->nullable();
            $table->foreign('setcountry_id', 'setcountry_fk_7256047')->references('id')->on('set_countries');
            $table->unsignedBigInteger('city_id')->nullable();
            $table->foreign('city_id', 'city_fk_7256048')->references('id')->on('cities');
            $table->unsignedBigInteger('quartier_id')->nullable();
            $table->foreign('quartier_id', 'quartier_fk_7256049')->references('id')->on('quartiers');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7256050')->references('id')->on('users');
            $table->unsignedBigInteger('liststatut_id')->nullable();
            $table->foreign('liststatut_id', 'liststatut_fk_7256051')->references('id')->on('list_statuts');
            $table->unsignedBigInteger('emergencylevel_id')->nullable();
            $table->foreign('emergencylevel_id', 'emergencylevel_fk_7256054')->references('id')->on('emergency_levels');
        });
    }
}
