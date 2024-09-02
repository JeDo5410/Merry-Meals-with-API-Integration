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

        Schema::create('delivers', function (Blueprint $table) {
            $table->id();
            $table->string('member_name');
            $table->string('member_address');
            $table->string('deliver_menu_name');
            $table->string('deliver_menu_type');
            $table->string('partner_restaurant_name');
            $table->string('partner_address');
            $table->string('volunteer_name')->nullable();
            $table->string('start_deliver_time')->nullable();
            $table->string('delivery_status')->nullable();
            $table->unsignedBigInteger('member_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('menu_id');
            $table->unsignedBigInteger('partner_id');
            $table->unsignedBigInteger('volunteer_id')->nullable();
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
        Schema::dropIfExists('delivers');
    }
};