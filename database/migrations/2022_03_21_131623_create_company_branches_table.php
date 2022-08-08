<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('company_branches', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('section_id')->nullable();
            $table->string('name')->nullable();
            $table->string('email',100)->nullable();
            $table->string('mobile_no',100)->nullable();
            $table->string('address')->nullable();
            $table->string('logo')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('company_branches');
    }
}
