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
        Schema::create('arm_payment_details', function (Blueprint $table) {
            $table->id();

            $table->string('report_id')->nullable();
            $table->text('report_name')->nullable();
            $table->string('report_price')->nullable();
            $table->string('license_type')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_mobile')->nullable();
            $table->string('payment_method')->nullable();
            $table->string('country')->nullable();
            $table->string('payment_id')->nullable();
            $table->enum('payment_status',['pending','paid'])->default('pending');

            $table->enum('status',['active','delete','inactive'])->default('active');
            $table->string('created_ip_address')->nullable();
            $table->string('modified_ip_address')->nullable();
            $table->string('created_by')->nullable();
            $table->string('modified_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arm_payment_details');
    }
};
