<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryProcessDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_process_details', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('salary_process_id');
            $table->unsignedBigInteger('employee_id');
            $table->date('date')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->tinyInteger('payment_method')->nullable()->comment('1=Cash In hand, 2=Bank');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->double('month_days', 20, 6)->nullable()->default(0);
            $table->double('leave_days', 20, 6)->nullable()->default(0);
            $table->double('absent_days', 20, 6)->nullable()->default(0);
            $table->double('payble_days', 20, 6)->nullable()->default(0);
            $table->double('salary', 20, 6)->nullable()->default(0);
            $table->double('others_addition', 20, 6)->nullable()->default(0);
            $table->double('absent_deduct', 20, 6)->nullable()->default(0);
            $table->double('others_deduct', 20, 6)->nullable()->default(0);
            $table->double('per_day_salary', 20, 6)->nullable()->default(0);
            $table->double('net_salary', 20, 6)->nullable()->default(0);
            $table->tinyInteger('status')->default(1);
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
        Schema::dropIfExists('salary_process_details');
    }
}
