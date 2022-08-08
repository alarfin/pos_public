<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('designation_logs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->default(1);
            $table->string('employee_id');
            $table->string('designation_id');
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
        Schema::dropIfExists('designation_logs');
    }
}
