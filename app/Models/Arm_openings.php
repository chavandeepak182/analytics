<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_openings extends Model
{
    use HasFactory;
    protected $table ='arm_career_openings';

    protected $fillable = [
               'heading',
               'experience',
               'number_of_positions',
               'location',
            
               'status',
               'created_ip_address',
               'modified_ip_address',
                'created_by',
                'modified_by',
    ];
}
