<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_privacy_policy extends Model
{
    use HasFactory;
    protected $table ='arm_privacy_policy';

    protected $fillable = [
               'heading',
               'description',
           
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
