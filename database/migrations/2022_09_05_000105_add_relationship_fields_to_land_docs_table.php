<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToLandDocsTable extends Migration
{
    public function up()
    {
        Schema::table('land_docs', function (Blueprint $table) {
            $table->unsignedBigInteger('land_id')->nullable();
            $table->foreign('land_id', 'land_fk_7255602')->references('id')->on('lands');
            $table->unsignedBigInteger('typeadmdoc_id')->nullable();
            $table->foreign('typeadmdoc_id', 'typeadmdoc_fk_7255603')->references('id')->on('type_adm_docs');
        });
    }
}
