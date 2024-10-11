<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admins extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $guard = 'arm_admins';
    protected $table = 'arm_master_admins';

    protected $fillable = [
        'user_name',
        'email',
        'password',
        'mobile_no',
        'role_id',
        'address',
        'user_profile_image_path',
        'user_profile_image_name',
        'fcm_token',
        'access_token',
        'last_login',
        'remember_token',
        'otp',
        'status',
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
    ];
}
