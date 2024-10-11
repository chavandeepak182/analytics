<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Arm_reports;

class ReportCategory extends Model
{
    use HasFactory;
    protected $table = 'arm_report_categories';

    protected $fillable = [
        'category_name',
        'heading',
        'description',
        'image_path',
        'image_name',

        'created_ip_address',
        'modified_ip_address',
        'created_by',
        'modified_by',
        'status', 
    ];

    public function reports()
    {
        return $this->belongsTo(Arm_reports::class, 'category_id');
    }
}
