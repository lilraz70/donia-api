<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCarpoolsTable extends Migration
{
    public function up()
    {
        Schema::table('carpools', function (Blueprint $table) {
            $table->unsignedBigInteger('user_client_id')->nullable();
            $table->foreign('user_client_id', 'user_client_fk_7255514')->references('id')->on('users');
            $table->unsignedBigInteger('user_fournisseur_id')->nullable();
            $table->foreign('user_fournisseur_id', 'user_fournisseur_fk_7255515')->references('id')->on('users');
            $table->unsignedBigInteger('paymentmode_id')->nullable();
            $table->foreign('paymentmode_id', 'paymentmode_fk_7255518')->references('id')->on('payment_modes');
            $table->unsignedBigInteger('trip_id')->nullable();
            $table->foreign('trip_id', 'trip_fk_7255521')->references('id')->on('trips');
            $table->unsignedBigInteger('liststatut_id')->nullable();
            $table->foreign('liststatut_id', 'liststatut_fk_7255522')->references('id')->on('list_statuts');
            $table->unsignedBigInteger('carpoolingvehicle_id')->nullable();
            $table->foreign('carpoolingvehicle_id', 'carpoolingvehicle_fk_7255996')->references('id')->on('carpooling_vehicles');
        });
    }
}
