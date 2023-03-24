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
        Schema::table('shops', function (Blueprint $table) {
            //drop foreigns
            $table->dropColumn('users_customer_id');
            $table->dropColumn('users_owner_id');
            $table->dropColumn('factures_id');
            $table->dropForeign('users_customer');
            $table->dropForeign('users_owner');
            $table->dropForeign('factures');

            //foreign keys
            $table->foreignId('owner_user_id')->index('owner_user');
            $table->foreign('owner_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('customer_user_id')->index('customer_user');
            $table->foreign('customer_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('facture_id')->index('facture');
            $table->foreign('facture_id')->references('id')->on('factures')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shops', function (Blueprint $table) {
            //
        });
    }
};
