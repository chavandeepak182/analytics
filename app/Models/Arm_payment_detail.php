<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_payment_detail extends Model
{
    use HasFactory;

    protected $table ='arm_payment_details';
    protected $fillable = [
        'report_id',
        'report_name',
        'report_price',
        'license_type',
        'user_name',
        'user_email',
        'user_mobile',
        'payment_method',
        'country',
        'payment_id',
        'payment_status',

        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];
}
