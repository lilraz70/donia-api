<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHostingAvailabilitiesTable extends Migration
{
    public function up()
    {
        Schema::table('hosting_availabilities', function (Blueprint $table) {
            $table->unsignedBigInteger('lodging_id')->nullable();
            $table->foreign('lodging_id', 'lodging_fk_7255927')->references('id')->on('lodgings');
        });
    }
}
