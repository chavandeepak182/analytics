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
        Schema::create('arm_research_methodology', function (Blueprint $table) {
            $table->id();
            $table->string('section_1_heading')->nullable();
            $table->longText('section_1_description')->nullable();

            $table->string('section_2_heading')->nullable();
            $table->longText('section_2_description')->nullable();

            $table->string('section_3_heading')->nullable();
            $table->longText('section_3_description')->nullable();


            $table->string('section_4_heading')->nullable();
            $table->longText('section_4_description_1')->nullable();
            $table->longText('section_4_description_2')->nullable();
            $table->string('section_4_image_path_1')->nullable();
            $table->string('section_4_image_name_1')->nullable();
            $table->string('section_4_sub_heading_1')->nullable();
            $table->longText('section_4_sub_description_1')->nullable();
            $table->string('section_4_image_path_2')->nullable();
            $table->string('section_4_image_name_2')->nullable();
            $table->string('section_4_sub_heading_2')->nullable();
            $table->longText('section_4_sub_description_2')->nullable();
            $table->string('section_4_image_path_3')->nullable();
            $table->string('section_4_image_name_3')->nullable();
            $table->string('section_4_sub_heading_3')->nullable();
            $table->longText('section_4_sub_description_3')->nullable();
            $table->string('section_4_image_path_4')->nullable();
            $table->string('section_4_image_name_4')->nullable();


            

            $table->string('created_ip_address')->nullable();
            $table->string('modified_ip_address')->nullable();
            $table->bigInteger('created_by')->nullable();
            $table->bigInteger('modified_by')->nullable();
            $table->enum('status', ['active', 'delete', 'inactive'])->default('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arm_research_methodology');
    }
};
