<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_contact_us_query extends Model
{
    use HasFactory;
    protected $table = 'arm_contact_us_query';

    protected $fillable = [
                'fname',
                'lname',
                'email',
                'phone',
                'company_name',
                'message',
                'country',
            
                'created_ip_address',
                'modified_ip_address',
                'created_by',
                'modified_by',
                'status',
    ];
}
