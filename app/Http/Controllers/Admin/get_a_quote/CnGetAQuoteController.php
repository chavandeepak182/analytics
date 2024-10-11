<?php

namespace App\Http\Controllers\Admin\get_a_quote;

use App\Exports\GetAQuoteExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Get_a_quote;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use Storage;

class CnGetAQuoteController extends Controller
{
    public function index(){
        return view('admin.get_a_quote.get-a-quote');
    }

    public function get_a_quote_data_table(Request $request){
        $get_a_quote = Get_a_quote::where('status', '!=', 'delete')->orderBy('id', 'DESC')->select('id','name','email','mobile','company','country','budget','services','browser','created_ip_address','requirement','file_name','file_path','created_at')->get();
        if ($request->ajax()) {
            return DataTables::of($get_a_quote)
            ->addIndexColumn()
            ->addColumn('select', function ($row) {
                return '<input type="checkbox" class="user_checkbox" name="user_checkbox" value="' . $row->id . '   " data-id="' . $row->id . '">';
            })
            ->addColumn('created_at', function ($row) {
                return !empty($row->created_at) ? date('d-M-Y h:i:s a', strtotime($row->created_at)) : '';
            })
            ->addColumn('name', function ($row) {
                if (!empty($row->name)) {
                    return ucfirst($row->name);
                } 
            })
            ->addColumn('email', function ($row) {
                if (!empty($row->email)) {
                    return $row->email;
                } 
            })
            ->addColumn('mobile', function ($row) {
                if (!empty($row->mobile)) {
                    return $row->mobile;
                } 
            })
            ->addColumn('company', function ($row) {
                if (!empty($row->company)) {
                    return ucfirst($row->company);
                } 
            })
            ->addColumn('country', function ($row) {
                if (!empty($row->country)) {
                    return ucfirst($row->country);
                } 
            })
            ->addColumn('services', function ($row) {
                if (!empty($row->services)) {
                    return ucfirst($row->services);
                } 
            })
            ->addColumn('budget', function ($row) {
                if (!empty($row->budget)) {
                    return ucfirst($row->budget);
                } 
            })
            ->addColumn('document', function ($row) {
                if (!empty($row->file_path && Storage::exists($row->file_path))) {
                    return '<a href="'.url('/').Storage::url($row->file_path).'" download><i class="fa fa-download"></i></a>';
                } 
            })
            // ->addColumn('document', function ($row) {
            //     if (!empty($row->document_path) && Storage::exists($row->document_path)) {
            //         return '<a href="'.url('/').Storage::url($row->document_path).'" download><i class="fa fa-download"></i></a>';
            //     } 
            // })
            ->addColumn('requirement', function ($row) {
                if (!empty($row->requirement)) {
                    return ucfirst($row->requirement);
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
                $actionBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="get_a_quotes" data-flash="Get A Quote Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                return $actionBtn;
            })
            ->rawColumns(['document','action','select'])
            ->make(true);
        }
    }
    public function exportquotes()
    {
        $getaquote = Get_a_quote::select('id','name','email','mobile','company','country','budget','services','browser','created_ip_address','requirement','created_at')
            ->where('status', '!=', 'delete')
            ->get();
        return Excel::download(new GetAQuoteExport($getaquote), 'get_a_quotes.xlsx', \Maatwebsite\Excel\Excel::XLSX);
    }

    public function deleteSelected(Request $request)
    {
      
        $deleted = Get_a_quote::whereIn('id', $request->ids)->delete();
        if ($deleted) {
            return response()->json(['success' => true], 200);
        } else {
            return response()->json(['success' => false], 400);
        }
    }
}
