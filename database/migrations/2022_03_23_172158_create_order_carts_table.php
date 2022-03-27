<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_carts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_attribute_id');
            $table->string('color');
            $table->string('size');
            $table->string('quantity');
            // $table->decimal('unit_buying_price');
            // $table->decimal('total_buying_price');
            // $table->decimal('unit_selling_price');
            // $table->decimal('total_selling_price');
            // $table->decimal('unit_profit');
            // $table->decimal('total_profit');
            
            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->onDelete('cascade');

            $table->foreign('product_attribute_id')
            ->references('id')
            ->on('product_attributes')
            ->onDelete('cascade');
            
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
        Schema::dropIfExists('order_carts');
    }
}
