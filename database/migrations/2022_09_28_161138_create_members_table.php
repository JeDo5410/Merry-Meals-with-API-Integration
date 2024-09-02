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
        Schema::create('members', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('member_caregiver_name');
            $table->string('member_caregiver_relation');
            $table->string('member_medical_condition');
            $table->string('member_medical_number');
            $table->string('member_meal_type')->nullable();
            $table->integer('member_meal_duration')->nullable();
            $table->string('member_extends_reason')->nullable();
            $table->string('reassessment_status')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('members');
    }
};