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
            $table->string('invoice')->unique();
            $table->string('order_name');
            $table->string('order_phone');
            $table->text('order_notes');
            $table->text('order_address');
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('subtotal');
            $table->integer('shipping_cost');
            $table->integer('total');
            $table->enum('courier', ['jne', 'pos']);
            $table->string('tracking_number')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('payment_proff_image')->nullable();
            $table->char('status');
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
        Schema::dropIfExists('orders');
    }
}
