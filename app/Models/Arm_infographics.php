<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_infographics extends Model
{
    use HasFactory;
    protected $table = 'arm_infographics';

    protected $fillable = [
      
                  'title',
                  'report_id',
                  'image_path',
                  'image_name',

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
