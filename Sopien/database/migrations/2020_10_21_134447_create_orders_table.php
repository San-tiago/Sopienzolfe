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
            $table->bigIncrements('id');
            $table->integer('order_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('menu_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('menu_id')->references('id')->on('menus');
            $table->string('email');
            $table->string('menu_name');
            $table->string('menu_category');
            $table->string('menu_description');
            $table->double('menu_price');
            $table->integer('quantity');
            $table->string('status')->default(' ');
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
