<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_client_logo extends Model
{
    use HasFactory;
    protected $table ='arm_client_logo';

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
