<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->unique();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('images')->nullable();
            $table->string('title')->nullable();
            $table->string('brand')->nullable();
            $table->longText('summary')->nullable();

            $table->foreign('category_id')
            ->references('id')
            ->on('categories')
            ->nullOnDelete();
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
}
