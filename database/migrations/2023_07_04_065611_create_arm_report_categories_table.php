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
        Schema::create('arm_report_categories', function (Blueprint $table) {
            $table->id();

            $table->string('category_name')->nullable();
            $table->string('heading')->nullable();
            $table->longText('description')->nullable();
            $table->string('image_path')->nullable();
            $table->string('image_name')->nullable();

            $table->text('meta_title')->nullable();
            $table->text('meta_keyword','1000')->nullable();
            $table->text('meta_description', '500')->nullable();

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
        Schema::dropIfExists('arm_report_categories');
    }
};
