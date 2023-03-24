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
        Schema::create('shops', function (Blueprint $table) {
            // model parameters
            $table->id();
            $table->date('date_shop');
            $table->boolean('shop_confirm')->get('false');
            $table->text('description')->nullable();

            //foreign keys
            $table->foreignId('users_owner_id')->index('users_owner');
            $table->foreign('users_owner_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('users_customer_id')->index('users_customer');
            $table->foreign('users_owner_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('factures_id')->index('users_customer');
            $table->foreign('factures_id')->references('id')->on('factures')->onUpdate('cascade')->onDelete('cascade');

            // model untils
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shops');
    }
};
