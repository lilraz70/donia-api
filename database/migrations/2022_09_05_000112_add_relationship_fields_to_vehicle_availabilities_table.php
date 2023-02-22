<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToVehicleAvailabilitiesTable extends Migration
{
    public function up()
    {
        Schema::table('vehicle_availabilities', function (Blueprint $table) {
            $table->unsignedBigInteger('sellrentcar_id')->nullable();
            $table->foreign('sellrentcar_id', 'sellrentcar_fk_7255991')->references('id')->on('sell_rent_cars');
        });
    }
}
