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
            $table->bigIncrements('id');
            $table->string("p_name");
            $table->integer('user_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->integer('sub_category_id')->unsigned();
            $table->integer('image')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign("category_id")->references('id')->on("categories")->onDelete('cascade');
            $table->foreign("sub_category_id")->references("id")->on('sub_categories');
            $table->foreign("image")->references("id")->on('product_images')->onDelete('cascade');
            $table->unsignedInteger('qty');
            $table->unsignedDecimal('unit_price',8,2);
            $table->unsignedDecimal("total_price",8,2);
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
