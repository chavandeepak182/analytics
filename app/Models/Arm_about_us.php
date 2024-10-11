<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_about_us extends Model
{
    use HasFactory;
    protected $table ='arm_about_us';

    protected $fillable = [
      

          'section_1_heading',
          'section_1_description_1',
          'section_1_description_2',
          'section_1_image_path',
          'section_1_image_name',

          'our_mission',
          'our_mission_description',

          'our_values',
          'our_values_description',

          'core_values',
          'core_values_description',

          'core_offerings',
          'core_offerings_description',

          'why_choose_us_heading',
          'why_choose_us_description_1',
          'why_choose_us_description_2',

          'meta_title',
          'meta_keyword',
          'meta_description',

          'status', 
          'created_ip_address',
          'modified_ip_address',
          'created_by',
          'modified_by',
    ];



}
