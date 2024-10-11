<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_news_letter extends Model
{
    use HasFactory;
    protected $fillable = [
        'email',
        'country',
        'created_ip_address',
        'created_by'
    ];
}
