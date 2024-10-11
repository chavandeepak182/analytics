<?php

namespace App\Exports;

use App\Models\Arm_payment_detail;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PaymentDetailExport implements FromView
{
    public $payment_details;

    public function __construct($payment_details)
    {
        $this->payment_details =  $payment_details;
    }

    public function view(): View
    {
        return view('admin.exports.payment_details', [
            'data' => $this->payment_details
        ]);
    }
}
