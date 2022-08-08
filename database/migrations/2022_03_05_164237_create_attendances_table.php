<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('employee_id');
            $table->unsignedBigInteger('company_branch_id');
            $table->date('date');
            $table->tinyInteger('present')->default(1)->comment('1=present,0=absent');
            $table->time('in_time')->nullable();
            $table->time('out_time')->nullable();
            $table->double('total_time', 20,2)->nullable()->default(0);
            $table->tinyInteger('late')->default(0);
            $table->text('note')->nullable();
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
        Schema::dropIfExists('attendances');
    }
}
