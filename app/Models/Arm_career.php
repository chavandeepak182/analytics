<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_career extends Model
{
    use HasFactory;
    protected $table ='arm_career';

    protected $fillable = [
            'heading',
            'description',
           
             'status',
             'created_ip_address',
             'modified_ip_address',
             'created_by',
             'modified_by',
    ];
}
