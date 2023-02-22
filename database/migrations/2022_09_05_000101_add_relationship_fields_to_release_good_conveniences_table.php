<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToReleaseGoodConveniencesTable extends Migration
{
    public function up()
    {
        Schema::table('release_good_conveniences', function (Blueprint $table) {
            $table->unsignedBigInteger('releasegood_id')->nullable();
            $table->foreign('releasegood_id', 'releasegood_fk_7255551')->references('id')->on('release_goods');
            $table->unsignedBigInteger('conveniencetype_id')->nullable();
            $table->foreign('conveniencetype_id', 'conveniencetype_fk_7255552')->references('id')->on('convenience_types');
        });
    }
}
