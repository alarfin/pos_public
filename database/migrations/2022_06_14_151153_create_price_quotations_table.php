<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePriceQuotationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('price_quotations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->default(1);
            $table->unsignedBigInteger('section_id')->default(1);
            $table->unsignedBigInteger('company_branch_id')->default(1);
            $table->string('invoice_no')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->date('date')->nullable();
            $table->tinyInteger('payment_method')->nullable()->comment('1=Cashb In Hand, 2=Bank');
            $table->double('product_discount', 20, 2)->nullable()->default(0);
            $table->double('discount', 20, 2)->nullable()->default(0);
            $table->double('total_discount', 20, 2)->nullable()->default(0);
            $table->double('tax', 20, 2)->nullable()->default(0);
            $table->double('vat', 20, 2)->nullable()->default(0);
            $table->double('product_sub_total', 20, 2)->nullable()->default(0);
            $table->double('sub_total', 20, 2)->nullable()->default(0);
            $table->double('total', 20, 2)->nullable()->default(0);
            $table->double('paid', 20, 2)->nullable()->default(0);
            $table->double('due', 20, 2)->nullable()->default(0);
            $table->text('note')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('delete_user_id')->nullable();
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
        Schema::dropIfExists('price_quotations');
    }
}
