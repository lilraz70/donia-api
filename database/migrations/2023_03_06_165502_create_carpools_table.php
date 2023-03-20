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
        Schema::create('carpools', function (Blueprint $table) {
            $table->comment('');
            $table->unsignedBigInteger('id');
            $table->string('paiement', 255);
            $table->string('preuve_paiement', 255)->nullable();
            $table->string('mention_arrive', 255)->nullable();
            $table->string('mention_arv_heure', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('user_client_id')->nullable();
            $table->unsignedBigInteger('user_fournisseur_id')->nullable();
            $table->unsignedBigInteger('paymentmode_id')->nullable();
            $table->unsignedBigInteger('trip_id')->nullable();
            $table->unsignedBigInteger('liststatut_id')->nullable();
            $table->unsignedBigInteger('carpoolingvehicle_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carpools');
    }
};
