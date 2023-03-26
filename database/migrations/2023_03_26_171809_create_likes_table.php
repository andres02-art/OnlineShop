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
            $table->id();
            $table->boolean('favorite')->get( false );
            $table->date('date_liked');
            $table->integer('liked')->unsigned();
            $table->boolean('pin_board')->get(false);


            // foreign keys
            $table->foreignID('owner_user_id')->index('owner_user');
            $table->foreign('owner_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('customer_user_id')->index('customer_user');
            $table->foreign('customer_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('likes');
    }
};
