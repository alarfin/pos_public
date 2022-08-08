<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineExpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_expenses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->nullable();
            $table->bigInteger('section_id')->nullable();
            $table->bigInteger('company_branch_id')->nullable();
            $table->unsignedBigInteger('account_head_id')->nullable();
            $table->unsignedBigInteger('account_id')->nullable();
            $table->string('serial_no')->nullable();
            $table->date('date')->nullable();
            $table->tinyInteger('payment_method')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->double('quantity', 20, 2)->default(0);
            $table->double('amount', 20, 2)->default(0);
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
        Schema::dropIfExists('online_expenses');
    }
}
