<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHostingServicesTable extends Migration
{
    public function up()
    {
        Schema::table('hosting_services', function (Blueprint $table) {
            $table->unsignedBigInteger('lodging_id')->nullable();
            $table->foreign('lodging_id', 'lodging_fk_7255938')->references('id')->on('lodgings');
            $table->unsignedBigInteger('servicesinclus_id')->nullable();
            $table->foreign('servicesinclus_id', 'servicesinclus_fk_7255939')->references('id')->on('servicesinclus');
        });
    }
}
