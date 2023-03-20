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
        Schema::create('approves', function (Blueprint $table) {
            $table->comment('');
            $table->unsignedBigInteger('id')->primary();
            $table->string('comment', 255);
            $table->integer('objet');
            $table->string('resultat', 255);
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('user_id')->nullable()->index('user_fk_7255352');
            $table->unsignedBigInteger('objecttype_id')->nullable()->index('objecttype_fk_7255353');
            $table->unsignedBigInteger('reason_id')->nullable()->index('reason_fk_7255354');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('approves');
    }
};
