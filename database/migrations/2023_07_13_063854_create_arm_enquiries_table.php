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
        Schema::create('arm_enquiries', function (Blueprint $table) {
            $table->id();

            $table->string('request_type', 100)->nullable();
            $table->string('report_id')->nullable();
            $table->text('report_title')->nullable();
            $table->string('name', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->string('mobile_number', 15)->nullable();
            $table->string('company_name',100)->nullable();
            $table->string('message', 1000)->nullable();
            $table->string('country')->nullable();

            $table->enum('status',['active','delete','inactive'])->default('active');
            $table->string('created_ip_address')->nullable();
            $table->string('modified_ip_address')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('modified_by')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arm_enquiries');
    }
};
