<?php

namespace App\Exports;

use Illuminate\Support\ServiceProvider;
use App\Models\Arm_career_application;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CarrerApplicationExport implements FromView
{
    public function view(): View
    {
        $career_application = Arm_career_application::where('status', '!=', 'delete')->orderBy('id','DESC')->select('id', 'created_at', 'application_for', 'name', 'email', 'phone', 'message','created_ip_address')->get();

        return view('admin.exports.career_application', [
            'data' => $career_application 
        ]);
    }
}
