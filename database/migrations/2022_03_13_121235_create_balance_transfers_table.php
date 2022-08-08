<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBalanceTransfersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('balance_transfers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('transfer_no')->nullable();
            $table->date('date')->nullable();
            $table->unsignedBigInteger('debit_account_id')->nullable();
            $table->unsignedBigInteger('debit_bank_id')->nullable();
            $table->unsignedBigInteger('credit_account_id')->nullable();
            $table->unsignedBigInteger('credit_bank_id')->nullable();
            $table->double('amount', 20, 6)->nullable()->default(0);
            $table->text('note')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('balance_transfers');
    }
}
