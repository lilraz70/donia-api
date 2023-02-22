<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLocalConveniencesTable extends Migration
{
    public function up()
    {
        Schema::table('local_conveniences', function (Blueprint $table) {
            $table->unsignedBigInteger('local_id')->nullable();
            $table->foreign('local_id', 'local_fk_7255596')->references('id')->on('locals');
            $table->unsignedBigInteger('conveniencetype_id')->nullable();
            $table->foreign('conveniencetype_id', 'conveniencetype_fk_7255597')->references('id')->on('convenience_types');
        });
    }
}
