<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToModelOfVehiclesTable extends Migration
{
    public function up()
    {
        Schema::table('model_of_vehicles', function (Blueprint $table) {
            $table->unsignedBigInteger('brand_id')->nullable();
            $table->foreign('brand_id', 'brand_fk_7253277')->references('id')->on('brands');
        });
    }
}
