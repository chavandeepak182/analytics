<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_research_methodology extends Model
{
    use HasFactory;

    protected $table ='arm_research_methodology';

    protected $fillable = [
                            'section_1_heading',
                             'section_1_description',

                            'section_2_heading',
                             'section_2_description',

                            'section_3_heading',
                             'section_3_description',


                            'section_4_heading',
                             'section_4_description_1',
                             'section_4_description_2',

                            'section_4_image_path_1',
                            'section_4_image_name_1',

                            'section_4_sub_heading_1',
                             'section_4_sub_description_1',

                            'section_4_image_path_2',
                            'section_4_image_name_2',

                            'section_4_sub_heading_2',
                             'section_4_sub_description_2',

                            'section_4_image_path_3',
                            'section_4_image_name_3',

                            'section_4_sub_heading_3',
                             'section_4_sub_description_3',
                             
                            'section_4_image_path_4',
                            'section_4_image_name_4',


            

                            'created_ip_address',
                            'modified_ip_address',
                            'created_by',
                            'modified_by',
                             'status',
    ];
}
