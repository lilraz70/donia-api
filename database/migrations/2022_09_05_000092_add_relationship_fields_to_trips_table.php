<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTripsTable extends Migration
{
    public function up()
    {
        Schema::table('trips', function (Blueprint $table) {
            $table->unsignedBigInteger('liststatut_id')->nullable();
            $table->foreign('liststatut_id', 'liststatut_fk_7255087')->references('id')->on('list_statuts');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_7255089')->references('id')->on('users');
            $table->unsignedBigInteger('typeoftrip_id')->nullable();
            $table->foreign('typeoftrip_id', 'typeoftrip_fk_7255090')->references('id')->on('type_of_trips');
        });
    }
}
