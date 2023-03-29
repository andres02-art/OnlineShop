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
        Schema::table('users', function (Blueprint $table) {
            $table->softDeletes();
            $table->string('credentials')->unique();
            $table->date('born_date');
            $table->date('death_date')->nullable();
            $table->text('catalogo')->nullable();
            $table->text('description')->nullable();
        });
    }
};
