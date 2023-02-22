<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToTripFrequenciesTable extends Migration
{
    public function up()
    {
        Schema::table('trip_frequencies', function (Blueprint $table) {
            $table->unsignedBigInteger('day_id')->nullable();
            $table->foreign('day_id', 'day_fk_7255179')->references('id')->on('days');
            $table->unsignedBigInteger('trip_id')->nullable();
            $table->foreign('trip_id', 'trip_fk_7255180')->references('id')->on('trips');
        });
    }
}
