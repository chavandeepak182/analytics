<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_home extends Model
{
    use HasFactory;

    protected $table ='arm_home';

    protected $fillable = [
          'section_1_heading',
          'section_1_sub_heading',
         'section_1_banner_content',
          'section_1_link',
          'section_1_respondents',
          'section_1_app_partners',
          'section_1_targeted_globally',
          'section_1_banner_image_path',
          'section_1_banner_image_name',

          'section_2_heading',
          'section_2_description',
          'section_2_image_path',
          'section_2_image_name',

          'section_3_heading',
         'section_3_description',
          'section_3_image_path',
          'section_3_image_name',



          'section_4_heading',
          'section_4_title_1',
          'section_4_title_2',
          'section_4_title_3',
          'section_4_title_4',
         'section_4_description_1',
         'section_4_description_2',
         'section_4_description_3',
         'section_4_description_4',
          'section_4_image_1_path',
          'section_4_image_1_name',
          'section_4_image_2_path',
          'section_4_image_2_name',


          'section_5_heading',
          'section_5_title_1',
          'section_5_title_2',
          'section_5_title_3',
         'section_5_description_1',
         'section_5_description_2',
         'section_5_description_3',

         'section_6_heading',
         'section_6_description',
            
          'meta_title',
          'meta_keyword',
          'meta_description',


          'created_ip_address',
          'modified_ip_address',
           'created_by',
           'modified_by',
            'status',
    ];
    
}
