<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arm_terms_of_use extends Model
{
    use HasFactory;
    protected $table ='terms_of_use';

    protected $fillable =[
        'heading',
        'description',

        'meta_title',
        'meta_keyword',
        'meta_description',


        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status',
    ];
}
