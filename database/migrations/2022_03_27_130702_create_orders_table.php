<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{

    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('sell_id');
            $table->unsignedBigInteger('product_attribute_id')->nullable();
            $table->string('color');
            $table->string('size');
            $table->string('quantity');

            $table->decimal('unit_buying_price');
            $table->decimal('total_buying_price');
            $table->decimal('unit_selling_price');
            $table->decimal('total_selling_price');
            $table->decimal('unit_profit');
            $table->decimal('total_profit');
            
            $table->foreign('product_id')
            ->references('id')
            ->on('products')
            ->nullOnDelete();

            $table->foreign('product_attribute_id')
            ->references('id')
            ->on('product_attributes')
            ->nullOnDelete();
                        
            $table->foreign('sell_id')
            ->references('id')
            ->on('sells')
            ->onDelete('cascade');
            
            $table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
