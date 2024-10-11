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
        Schema::create('arm_reports', function (Blueprint $table) {
            $table->id();

            $table->string('report_id')->nullable();
            $table->enum('top_selling',['yes','no'])->default('no');
            $table->enum('upcoming_report',['yes','no'])->default('no');
            $table->string('category_id')->nullable();
            $table->text('title')->nullable();
            $table->string('url')->nullable();
            $table->string('publisher')->default('we market research');
            $table->string('keyword')->nullable();
            $table->string('total_pages')->nullable();
            
            $table->string('single_user_cost')->nullable();
            $table->string('multi_user_cost')->nullable();
            $table->string('enterprise_user_cost')->nullable();
            $table->date('published_on')->nullable();
            $table->string('base_year')->nullable();
            $table->string('estimated_year')->nullable();
            $table->string('historical_data')->nullable();
            $table->string('forecast_period')->nullable();

            $table->longText('description')->nullable();
            $table->longText('table_of_content')->nullable();
            $table->longText('research_methodology')->nullable();
            $table->longText('infographics')->nullable();
            $table->text('meta_title')->nullable();
            $table->text('meta_keyword','1000')->nullable();
            $table->text('meta_description', '500')->nullable();

            $table->string('image_1_path')->nullable();
            $table->string('image_1_name')->nullable();
            $table->string('image_2_path')->nullable();
            $table->string('image_2_name')->nullable();
            $table->string('image_3_path')->nullable();
            $table->string('image_3_name')->nullable();

            $table->enum('faq_status',['active', 'inactive'])->default('active');
            $table->text('faq_question_1')->nullable();
            $table->text('faq_question_2')->nullable();
            $table->text('faq_question_3')->nullable();
            $table->text('faq_question_4')->nullable();
            $table->text('faq_question_5')->nullable();
            $table->text('faq_answer_1')->nullable();
            $table->text('faq_answer_2')->nullable();
            $table->text('faq_answer_3')->nullable();
            $table->text('faq_answer_4')->nullable();
            $table->text('faq_answer_5')->nullable();

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
        Schema::dropIfExists('arm_reports');
    }
};
