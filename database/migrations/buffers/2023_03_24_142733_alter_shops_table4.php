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
            $table->dropForeign('shops_users_customer_id_foreign');
            $table->dropForeign('shops_users_owner_id_foreign');
            $table->dropForeign('shops_factures_id_foreign');
            $table->dropColumn('users_customer_id');
            $table->dropColumn('users_owner_id');
            $table->dropColumn('factures_id');

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
