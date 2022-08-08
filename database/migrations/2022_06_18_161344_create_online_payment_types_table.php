<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlinePaymentTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('online_payment_types', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_id')->nullable();
            $table->bigInteger('section_id')->nullable();
            $table->bigInteger('company_branch_id')->nullable();
            $table->string('name', 255)->nullable();
            $table->text('description')->nullable();
            $table->bigInteger('user_id')->nullable();
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
        Schema::dropIfExists('online_payment_types');
    }
}
