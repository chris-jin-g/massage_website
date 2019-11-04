<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->string('refer_num');
            $table->string('client_name');
            $table->string('staff_id');
            $table->string('ordered_service');
            $table->string('room_num');
            $table->dateTime('start_time');
            $table->time('duration');
            $table->datetime('last_time');
            $table->string('cost');
            $table->boolean('pay_status');
            $table->string('current_state');
            $table->time('total_time');
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
