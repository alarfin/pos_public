<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceQuotationProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_quotation_products', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('company_branch_id')->nullable();
            $table->unsignedBigInteger('price_quotation_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('product_id')->nullable();
            $table->unsignedBigInteger('product_category_id')->nullable();
            $table->unsignedBigInteger('inventory_log_id')->nullable();
            $table->date('date')->nullable();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->string('warranty')->nullable();
            $table->string('guarantee')->nullable();
            $table->string('serial_no')->nullable();
            $table->double('product_discount', 20, 2)->nullable()->default(0);
            $table->double('discount', 20, 2)->nullable()->default(0);
            $table->double('quantity', 20, 2)->nullable()->default(0);
            $table->double('unit_price', 20, 2)->nullable()->default(0);
            $table->double('buy_price', 20, 2)->nullable()->default(0);
            $table->double('tax', 20, 2)->nullable()->default(0);
            $table->double('vat', 20, 2)->nullable()->default(0);
            $table->double('product_total', 20, 2)->nullable()->default(0);
            $table->double('buy_total', 20, 2)->nullable()->default(0);
            $table->double('total', 20, 2)->nullable()->default(0);
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
        Schema::dropIfExists('price_quotation_products');
    }
}
