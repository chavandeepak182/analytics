<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Arm_reports;

class Arm_relate_report extends Model
{
    use HasFactory;
    protected $fillable = [
        'report_id',
        'related_report_id',
        
        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status', 
    ];

    public function reports(){
        return $this->hasOne(Arm_reports::class, 'id', 'related_report_id')->select('*');
    }
}
