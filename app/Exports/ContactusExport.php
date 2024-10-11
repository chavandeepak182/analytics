<?php

namespace App\Exports;

use App\Models\Arm_contact_us_query;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\Font;

class ContactusExport implements FromView
{
    public function view(): View
    {
        $contacts = Arm_contact_us_query::where('status', '!=', 'delete')->orderBy('id','DESC')->select('id', 'created_at', 'fname', 'lname', 'phone', 'email', 'company_name', 'message', 'created_ip_address')->get();

        return view('admin.exports.contact_us', [
            'data' => $contacts
        ]);
    }
}
