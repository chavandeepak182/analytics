<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_career_application extends Model
{
    use HasFactory;
    protected $table ='career_application';

    protected $fillable = [
               'application_for',
               'name',
               'email',
               'phone',
               'message',
               'country',
           
               'file_name',
               'file_path',

               'created_ip_address',
               'modified_ip_address',
                'created_by',
                'modified_by',
                'status',
    ];
}
