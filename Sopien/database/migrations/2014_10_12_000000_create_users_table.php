<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('middlename');
            $table->string('lastname');
            $table->string('email');
            $table->boolean('is_admin')->default(false);
            $table->string('address')->nullable();
            $table->integer('contactnumber');
            $table->string('Order_Status')->default('None');
            $table->integer('completed_orders_count')->default(0);
            $table->integer('cancelled_orders_count')->default(0);
            $table->string('Account_Status')->default('Active');
            $table->string('password')->nullable();
            $table->string('amount_paid')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
