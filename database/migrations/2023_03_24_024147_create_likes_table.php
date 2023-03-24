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
        Schema::create('likes', function (Blueprint $table) {
            // model parameters
            $table->id();
            $table->boolean('favorite')->get( false );
            $table->date('date_liked');
            $table->integer('liked')->unsigned();
            $table->boolean('pin_board')->get(false);


            // foreign keys
            $table->foreignID('users_owner_id')->index('users_owner');
            $table->foreign('users_owner_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('users_customer_id')->index('users_customer');
            $table->foreign('users_customer_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('products_id')->index('products');
            $table->foreign('products_id')->references('id')->on('prodcuts')->onUpdate('cascade')->onDelete('cascade');


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
        Schema::dropIfExists('likes');
    }
};
