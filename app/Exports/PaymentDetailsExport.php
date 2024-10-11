<?php

namespace App\Exports;

use App\Models\Arm_payment_detail;

use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Contracts\View\View;
use PhpOffice\PhpSpreadsheet\Style\Font;

class PaymentDetailsExport implements FromView
{
    public function view(): View
    {

        $payments = Arm_payment_detail::where('status', '!=', 'delete')
        ->select('id', 'created_at', 'report_name', 'user_name', 'user_email', 'user_mobile', 'payment_method', 'payment_status', 'payment_id', 'report_price', 'license_type', 'created_ip_address')
        ->get();
        
        return view('admin.exports.payment_details', [
            'data' => $payments
        ]);
    }
}