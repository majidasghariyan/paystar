<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('amount')->nullable();
            $table->string('token')->nullable();
            $table->string('ref_num')->nullable();
            $table->boolean('is_pay')->default('0');
            $table->string('status')->nullable();
            $table->timestamp('pay_at')->nullable();
            $table->string('transaction_id')->nullable();
            $table->string('tracking_code')->nullable();
            $table->string('first_cart')->nullable();
            $table->string('last_cart')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
