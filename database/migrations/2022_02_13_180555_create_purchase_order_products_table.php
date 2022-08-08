<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrderProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('company_branch_id')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('product_color_id')->nullable();
            $table->unsignedBigInteger('product_size_id')->nullable();
            $table->unsignedBigInteger('product_category_id')->nullable();
            $table->unsignedBigInteger('inventory_log_id')->nullable();
            $table->date('date')->nullable();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->double('quantity', 20, 2)->nullable()->default(1);
            $table->double('unit_price', 20, 2)->nullable()->default(1);
            $table->double('discount', 20, 2)->nullable()->default(1);
            $table->double('product_total', 20, 2)->nullable()->default(1);
            $table->double('total', 20, 2)->nullable()->default(1);
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
        Schema::dropIfExists('purchase_order_products');
    }
}
