<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('student_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->string('std_name');
            $table->string('std_email')->unique();
            $table->string('std_id')->unique();
            $table->string('password', 6); // 6 digit random password
            $table->date('sub_start_date');
            $table->date('sub_end_date');
            $table->float('sub_fee');
            $table->enum('status', ['on', 'off'])->default('on');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('student_subscriptions');
    }
};
