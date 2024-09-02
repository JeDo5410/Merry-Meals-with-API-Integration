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
        Schema::table('members', function (Blueprint $table) {
            // Drop old columns
            $table->dropColumn('member_caregiver_name');
            $table->dropColumn('member_caregiver_relation');
            $table->dropColumn('member_medical_condition');
            $table->dropColumn('member_medical_number');
            $table->dropColumn('member_meal_type');
            $table->dropColumn('member_meal_duration');
            $table->dropColumn('member_extends_reason');

            // Add new columns
            $table->string('service_eligibility');
            $table->string('dietary');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('members', function (Blueprint $table) {
            // Add dropped columns
            $table->string('member_caregiver_name');
            $table->string('member_caregiver_relation');
            $table->string('member_medical_condition');
            $table->string('member_medical_number');
            $table->string('member_meal_type')->nullable();
            $table->integer('member_meal_duration');
            $table->string('member_extends_reason')->nullable();

            // Drop new columns
            $table->dropColumn('service_eligibility');
            $table->dropColumn('dietary');
        });
    }
};
