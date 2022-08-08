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
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('product_category_id')->nullable();
            $table->unsignedBigInteger('product_brand_id')->nullable();
            $table->unsignedBigInteger('product_unit_id')->nullable();
            $table->unsignedBigInteger('product_color_id')->nullable();
            $table->unsignedBigInteger('product_size_id')->nullable();
            $table->string('name');
            $table->string('code')->nullable();
            $table->double('buy_price', 20, 2)->nullable()->default(0);
            $table->double('sale_price', 20, 2)->nullable()->default(0);
            $table->double('whole_sale_price', 20, 2)->nullable()->default(0);
            $table->double('tax', 20, 2)->nullable()->default(0);
            $table->double('vat', 20, 2)->nullable()->default(0);
            $table->double('minimum_alert', 20, 2)->nullable()->default(0);
            $table->string('image')->nullable();
            $table->string('description')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('status')->default(1);
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
}
