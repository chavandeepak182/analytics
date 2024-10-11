<?php

namespace App\Http\Controllers\Admin\subscriber;

use App\Exports\SubscriberExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscriber;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;

class CnSubscriberController extends Controller
{
    public function index(){
        return view('admin.subscriber.subscriber');
    }

    public function subscriber_data_table(Request $request)
    {
        $subscriber = Subscriber::where('status', '!=', 'delete')->orderBy('id', 'DESC')->select('id','email','browser','created_ip_address','created_at')->get();

        if ($request->ajax()) {
            return DataTables::of($subscriber)
            ->addIndexColumn()
            ->addColumn('select', function ($row) {
                return '<input type="checkbox" class="user_checkbox" name="user_checkbox" value="' . $row->id . '   " data-id="' . $row->id . '">';
            })
            ->addColumn('created_at', function ($row) {
                return !empty($row->created_at) ? date('d-M-Y h:i:s a', strtotime($row->created_at)) : '';
            })
            ->addColumn('email', function ($row) {
                if (!empty($row->email)) {
                    return $row->email;
                } 
            })
            ->addColumn('created_by', function ($row) {
                if (!empty($row->created_by)) {
                    return ucfirst($row->created_by);
                }
            })
            ->addColumn('browser', function ($row) {
                if (!empty($row->browser)) {
                    return ucfirst($row->browser);
                }
            })
            ->addColumn('action', function ($row) 
            {
                $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="subscribers" data-flash="Subscriber Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['action','select'])
            ->make(true);
        }
    }
    public function exportsubscriber()
    {
        $subscribers = Subscriber::select('id','email','browser','created_ip_address','created_at')
            ->where('status', '!=', 'delete')
            ->get();
        return Excel::download(new SubscriberExport($subscribers), 'subscribers.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    
    public function deleteSelected(Request $request)
    {
        
        $deleted = Subscriber::whereIn('id', $request->ids)->delete();
        if ($deleted) {
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 400);
        }
    }

    
}





