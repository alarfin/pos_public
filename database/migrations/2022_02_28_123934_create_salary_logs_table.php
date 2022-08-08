<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalaryLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salary_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->default(1);
            $table->string('employee_id');
            $table->string('note',700);
            $table->string('type',500)->comment('1=promotion,2=increment,3=performance,4=decrement,5=other');
            $table->date('date')->nullable();
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
        Schema::dropIfExists('salary_logs');
    }
}
