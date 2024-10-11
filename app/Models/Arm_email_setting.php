<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_email_setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'mail_protocol',
        'mail_title',
        'mail_host',
        'mail_port',
        'mail_encryption',
        'mail_username',
        'mail_password',

        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status',
    ];
}
