<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('release_good_conveniences', function (Blueprint $table) {
            //$table->integer('number')->after('conveniencetype_id')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('release_good_conveniences', function (Blueprint $table) {
            //$table->dropColumn('number');
        });
    }
};
