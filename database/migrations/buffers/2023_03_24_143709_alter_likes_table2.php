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
        Schema::table('likes', function (Blueprint $table) {
            // drop foreigns
            $table->dropForeign('likes_users_owner_id_foreign');
            $table->dropForeign('likes_users_customer_id_foreign');
            $table->dropForeign('likes_products_id_foreign');
            $table->dropColumn('users_owner_id');
            $table->dropColumn('users_customer_id');
            $table->dropColumn('products_id');


            // foreign keys
            $table->foreignID('owner_user_id')->index('owner_user');
            $table->foreign('owner_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('customer_user_id')->index('customer_user');
            $table->foreign('customer_user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignID('product_id')->index('product');
            $table->foreign('product_id')->references('id')->on('products')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('likes', function (Blueprint $table) {
            //
        });
    }
};
