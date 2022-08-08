<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->tinyInteger('type')->nullable()->comment('1=Debit, 2=Credit	');
            $table->string('transaction_no')->nullable();
            $table->date('date')->nullable();
            $table->tinyInteger('payment_method')->nullable()->comment('1=Cash,2=Bank,3=Credit');
            $table->double('amount', 20, 6)->nullable()->default(0);
            $table->unsignedBigInteger('online_information_id')->nullable();
            $table->text('remark')->nullable();
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('transactions');
    }
}
