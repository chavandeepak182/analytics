<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_home_page_banner extends Model
{
    use HasFactory;
    protected $table ='arm_home_page_banner';

    protected $fillable = [
        'image_path',
        'image_name',

        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status',
    ];
}
