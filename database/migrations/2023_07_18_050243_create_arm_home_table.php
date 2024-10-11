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
        Schema::create('arm_home', function (Blueprint $table) {
            $table->id();
            $table->string('section_1_heading')->nullable();
            $table->string('section_1_sub_heading')->nullable();
            $table->longText('section_1_banner_content')->nullable();
            $table->string('section_1_link')->nullable();
            $table->string('section_1_respondents')->nullable();
            $table->string('section_1_app_partners')->nullable();
            $table->string('section_1_targeted_globally')->nullable();
            $table->string('section_1_banner_image_path')->nullable();
            $table->string('section_1_banner_image_name')->nullable();

            $table->string('section_2_heading')->nullable();
            $table->longText('section_2_description')->nullable();
            $table->string('section_2_image_path')->nullable();
            $table->string('section_2_image_name')->nullable();

            $table->string('section_3_heading')->nullable();
            $table->longText('section_3_description')->nullable();
            $table->string('section_3_image_path')->nullable();
            $table->string('section_3_image_name')->nullable();



            $table->string('section_4_heading')->nullable();
            $table->string('section_4_title_1')->nullable();
            $table->string('section_4_title_2')->nullable();
            $table->string('section_4_title_3')->nullable();
            $table->string('section_4_title_4')->nullable();
            $table->longText('section_4_description_1')->nullable();
            $table->longText('section_4_description_2')->nullable();
            $table->longText('section_4_description_3')->nullable();
            $table->longText('section_4_description_4')->nullable();
            $table->string('section_4_image_1_path')->nullable();
            $table->string('section_4_image_1_name')->nullable();
            $table->string('section_4_image_2_path')->nullable();
            $table->string('section_4_image_2_name')->nullable();


            $table->string('section_5_heading')->nullable();
            $table->string('section_5_title_1')->nullable();
            $table->string('section_5_title_2')->nullable();
            $table->string('section_5_title_3')->nullable();
            $table->longText('section_5_description_1')->nullable();
            $table->longText('section_5_description_2')->nullable();
            $table->longText('section_5_description_3')->nullable();

            $table->string('section_6_heading')->nullable();
            $table->longText('section_6_description')->nullable();
            
            $table->string('meta_title')->nullable();
            $table->string('meta_keyword')->nullable();
            $table->string('meta_description')->nullable();


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
        Schema::dropIfExists('arm_home');
    }
};
