<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_general_settings extends Model
{
    use HasFactory;
    protected $table = 'arm_general_settings';

    protected $fillable = [
             'email',
             'mobile',
             'address',
             'map_link',

             'facebook_url',
             'linkedin_url',
             'instagram_url',
             'twitter_url',
             'skype_url',

             'created_ip_address',
             'modified_ip_address',
              'created_by',
              'modified_by',
               'status',
    ];
}
