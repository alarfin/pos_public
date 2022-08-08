<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('source_branch_id')->nullable();
            $table->unsignedBigInteger('target_branch_id')->nullable();
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('product_color_id')->nullable();
            $table->unsignedBigInteger('product_size_id')->nullable();
            $table->unsignedBigInteger('product_category_id')->nullable();
            $table->unsignedBigInteger('product_brand_id')->nullable();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->date('date');
            $table->double('buy_price', 20, 2)->nullable()->default(0);
            $table->double('quantity', 20, 2)->nullable()->default(0);
            $table->double('total', 20, 2)->nullable()->default(0);
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
        Schema::dropIfExists('product_transfers');
    }
}
