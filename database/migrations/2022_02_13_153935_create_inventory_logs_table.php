<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventory_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_color_id')->nullable();
            $table->unsignedBigInteger('product_size_id')->nullable();
            $table->unsignedBigInteger('product_category_id')->nullable();
            $table->string('code')->nullable();
            $table->tinyInteger('stock_type')->default(1)->comment('1=Purchase,2=Manually Stock, 3=Sale');
            $table->tinyInteger('type')->default(1)->comment('1=In, 2=Out');
            $table->date('date');
            $table->double('quantity', 20, 2)->nullable()->default(0);
            $table->double('unit_price', 20, 2)->nullable()->default(0);
            $table->double('total', 20, 2)->nullable()->default(0);
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->unsignedBigInteger('purchase_order_id')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->unsignedBigInteger('sale_order_id')->nullable();
            $table->text('note')->nullable();
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
        Schema::dropIfExists('inventory_logs');
    }
}
