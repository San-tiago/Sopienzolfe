<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReceiverDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receiver_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('fromemail');
            $table->string('receivername');
            $table->string('receiveraddress');
            $table->string('province');
            $table->string('municipality/city');
            $table->string('receivercontactnumber');
            $table->string('transac_status')->default('0');
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
        Schema::dropIfExists('receiver_details');
    }
}
