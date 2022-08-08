<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->default(1);
            $table->unsignedBigInteger('section_id')->default(1);
            $table->unsignedBigInteger('company_branch_id')->nullable();
            $table->string('invoice_no')->nullable();
            $table->unsignedBigInteger('supplier_id')->nullable();
            $table->date('date')->nullable();
            $table->tinyInteger('payment_method')->nullable()->comment('1=Cash In Hand, 2=Bank');
            $table->double('discount', 20, 2)->nullable()->default(0);
            $table->double('sub_total', 20, 2)->nullable()->default(0);
            $table->double('total', 20, 2)->nullable()->default(0);
            $table->double('paid', 20, 2)->nullable()->default(0);
            $table->double('due', 20, 2)->nullable()->default(0);
            $table->text('note')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
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
        Schema::dropIfExists('purchase_orders');
    }
}
