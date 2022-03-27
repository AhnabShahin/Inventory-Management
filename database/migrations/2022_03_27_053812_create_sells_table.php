<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSellsTable extends Migration
{

    public function up()
    {
        Schema::create('sells', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('sell_id')->unique();
            $table->decimal('cost_price');
            $table->decimal('sell_price_before_discount');
            $table->decimal('discount')->nullable();
            $table->decimal('sell_price_after_discount');
            $table->decimal('profit_margin');
            $table->longText('delivery_address')->nullable();
            $table->decimal('payment_type')->nullable();

            $table->foreign('customer_id')
            ->references('id')
            ->on('customers')
            ->nullOnDelete();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sells');
    }
}
