<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToListStatutsTable extends Migration
{
    public function up()
    {
        Schema::table('list_statuts', function (Blueprint $table) {
            $table->unsignedBigInteger('objecttype_id')->nullable();
            $table->foreign('objecttype_id', 'objecttype_fk_7252829')->references('id')->on('objecttypes');
        });
    }
}
