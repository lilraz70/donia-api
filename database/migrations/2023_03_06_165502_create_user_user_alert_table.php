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
        Schema::create('user_user_alert', function (Blueprint $table) {
            $table->comment('');
            $table->unsignedBigInteger('user_alert_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('read')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_user_alert');
    }
};
