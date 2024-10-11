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
        Schema::create('arm_about_us', function (Blueprint $table){
            $table->id();
            $table->string('section_1_heading')->nullable();
            $table->longText('section_1_description_1')->nullable();
            $table->longText('section_1_description_2')->nullable();
            $table->string('section_1_image_path')->nullable();
            $table->string('section_1_image_name')->nullable();

            $table->string('our_mission')->nullable();
            $table->longText('our_mission_description')->nullable();

            $table->string('our_values')->nullable();
            $table->longText('our_values_description')->nullable();

            $table->string('core_values')->nullable();
            $table->longText('core_values_description')->nullable();

            $table->string('core_offerings')->nullable();
            $table->longText('core_offerings_description')->nullable();


            $table->string('why_choose_us_heading')->nullable();
            $table->longText('why_choose_us_description_1')->nullable();
            $table->longText('why_choose_us_description_2')->nullable();

            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();

            $table->enum('status', ['active', 'delete', 'inactive'])->default('active');
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
        Schema::dropIfExists('arm_about_us');
    }
};
