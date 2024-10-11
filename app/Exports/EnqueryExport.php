<?php

namespace App\Exports;

use App\Models\Arm_enquiry;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class EnqueryExport implements FromView
{
    public  $enquiry;

    public function __construct($enquiry)
    {
        $this->enquiry =  $enquiry;
    }

    public function view(): View
    {
        return view('admin.exports.enquiry', [
            'data' => $this->enquiry
        ]);
    }
}
