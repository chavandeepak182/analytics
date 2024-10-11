<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ReportCategory;


class Arm_reports extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'title',
        'url',
        'publisher',
        'published_on',
        'keyword',
        'total_pages',

        'single_user_cost',
        'multi_user_cost',
        'enterprise_user_cost',
        'base_year',
        'estimated_year',
        'historical_data',
        'forecast_period',
        'description',

        'table_of_content',
        'research_methodology',
        'infographics',
        'meta_title',
        'meta_keyword',
        'meta_description',

        'image_1_path',
        'image_1_name',
        'image_2_path',
        'image_2_name',
        'image_3_path',
        'image_3_name',

        'faq_question_1',
        'faq_question_2',
        'faq_question_3',
        'faq_question_4',
        'faq_question_5',
        'faq_answer_1',
        'faq_answer_2',
        'faq_answer_3',
        'faq_answer_4',
        'faq_answer_5',

        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by'
    ];


    public function category()
    {
        return $this->hasMany(ReportCategory::class, 'category_id', 'id');
    }
}
