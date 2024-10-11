<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_services_consulting extends Model
{
    use HasFactory;

    protected $table ='arm_services_consulting';

    protected $fillable = [

          'banner_heading',
          'description',
          'banner_image_path',
          'banner_image_name',
            
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
