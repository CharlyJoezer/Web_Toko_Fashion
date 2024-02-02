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
            $table->id('id_product');
            $table->string('name_product');
            $table->text('image_product');
            $table->integer('price_product');
            $table->smallInteger('stock_product');
            $table->smallInteger('min_order');
            $table->integer('quantity_sold');

            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id_category')->on('categories_product')->onDelete('cascade');

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
