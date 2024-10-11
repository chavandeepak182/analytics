<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_why_choose_us extends Model
{
    use HasFactory;
    protected $table = 'arm_why_choose_us_content';

    protected $fillable = [

         'content_title',
          'content_description',
          'content_image_path',
          'content_image_name',

          'status',
          'created_ip_address',
          'modified_ip_address',
          'created_by',
          'modified_by',
    ];
}
