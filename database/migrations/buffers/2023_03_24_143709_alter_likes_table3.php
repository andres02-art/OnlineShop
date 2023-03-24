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
