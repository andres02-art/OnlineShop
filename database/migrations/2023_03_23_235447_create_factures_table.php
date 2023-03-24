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
        Schema::create('factures', function (Blueprint $table) {
            // model parameters
            $table->id();
            $table->float('sub_total')->unsigned();
            $table->float('total_purchase')->unsigned();
            $table->text('method');
            $table->text('token');

            // foreign keys
            $table->foreignId('type_id')->index('type');
            $table->foreign('type_id')->references('id')->on('types')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('user_id')->index('user');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreignID('car_id')->index('car');
            $table->foreign('car_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('product_id')->index('product');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');

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
        Schema::dropIfExists('factures');
    }
};
