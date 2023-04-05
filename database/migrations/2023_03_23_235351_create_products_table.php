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
        Schema::create('products', function (Blueprint $table) {
            // model parameters
            $table->id();
            $table->double('precio');
            $table->text('catalogo');
            $table->text('description');
            $table->text('img')->nullable();

            // class parameters
            $table->string('name');
            $table->boolean('prom')->get(false);
            $table->string('mark');
            $table->string('company')->nullable();

            //foreign keys
            $table->foreignId('category_id')->index('category');
            $table->foreign('category_id')->references('id')->on('categories')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('promotion_id')->index('promotion');
            $table->foreign('promotion_id')->references('id')->on('promotions')->onUpdate('cascade')->onDelete('restrict');

            // midel untils
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
        Schema::dropIfExists('products');
    }
};
