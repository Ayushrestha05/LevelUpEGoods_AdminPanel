<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('txn_id');
            $table->double('sub_total');
            $table->integer('discount_percentage')->default(0);
            $table->double('discount_amount')->default(0);
            $table->double('total');
            $table->string('reciever_name');
            $table->string('reciever_phone');
            $table->string('reciever_email');
            $table->string('reciever_city');
            $table->string('reciever_address');
            $table->text('sender_message')->nullable();
            $table->boolean('hidden');
            $table->boolean('wrapped');
            $table->string('status')->default('pending');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
