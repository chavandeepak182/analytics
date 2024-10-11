<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_enquiry extends Model
{
    use HasFactory;

    protected $fillable = [
        'request_type',
        'report_id',
        'report_title',
        'name',
        'email',
        'mobile_number',
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
