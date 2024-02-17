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
        Schema::create('orders', function (Blueprint $table) {
            $table->id('id_order');
            $table->string('order_code')->unique();
            $table->json('list_order_product');
            $table->integer('total_price');
            $table->boolean('status_payment')->default(false);
            $table->enum('status_order', [false, 'created', 'process', 'sent', 'arrived'])->default(false);
            $table->enum('user_rating', [false, 1, 2, 3, 4, 5])->default(false);
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id_user')->on('users')->onDelete('cascade');

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
        Schema::dropIfExists('orders');
    }
};
