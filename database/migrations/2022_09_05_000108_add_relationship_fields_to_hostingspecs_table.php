<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToHostingspecsTable extends Migration
{
    public function up()
    {
        Schema::table('hostingspecs', function (Blueprint $table) {
            $table->unsignedBigInteger('lodging_id')->nullable();
            $table->foreign('lodging_id', 'lodging_fk_7255932')->references('id')->on('lodgings');
            $table->unsignedBigInteger('conveniencetype_id')->nullable();
            $table->foreign('conveniencetype_id', 'conveniencetype_fk_7255933')->references('id')->on('convenience_types');
        });
    }
}
