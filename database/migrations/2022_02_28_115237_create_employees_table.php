<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->default(1);
            $table->string('id_no');
            $table->unsignedBigInteger('designation_id');
            $table->string('name');
            $table->string('email');
            $table->string('father_name')->nullable();
            $table->string('mother_name')->nullable();
            $table->string('photo')->nullable();
            $table->string('signature')->nullable();
            $table->string('salary')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('permanent_address',500)->nullable();
            $table->string('present_address',500)->nullable();
            $table->date('join_date')->nullable();
            $table->string('nid_no')->nullable();
            $table->string('mobile_no')->nullable();
            $table->tinyInteger('religion')->comment('1=Islam,2=Hinduism,3=Christianity,4=Buddhism,5=Others')->nullable();
            $table->tinyInteger('gender')->comment('1=male,2=female,3=other')->nullable();
            $table->tinyInteger('marital_status')->comment('1=single,2=married,3=divorced,4=other')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('own_id')->nullable();
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
        Schema::dropIfExists('employees');
    }
}
