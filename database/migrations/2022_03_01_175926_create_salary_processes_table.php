<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryProcessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_processes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->string('salary_process_no')->nullable();
            $table->date('date')->nullable();
            $table->string('month')->nullable();
            $table->string('year')->nullable();
            $table->tinyInteger('payment_method')->nullable()->comment('1=Cash In hand, 2=Bank');
            $table->unsignedBigInteger('bank_id')->nullable();
            $table->double('total', 20, 6)->nullable()->default(0);
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
        Schema::dropIfExists('salary_processes');
    }
}
