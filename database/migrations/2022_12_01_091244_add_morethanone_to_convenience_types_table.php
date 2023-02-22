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
        Schema::table('convenience_types', function (Blueprint $table) {
            $table->boolean('morethanone')->after('deleted_at')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('convenience_types', function (Blueprint $table) {
            $table->dropColumn('morethanone');
        });
    }
};
