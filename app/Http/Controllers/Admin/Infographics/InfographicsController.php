<?php

namespace App\Http\Controllers\Admin\Infographics;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_infographics;
use App\Models\Arm_reports;
use App\Traits\MediaTrait;
use Yajra\DataTables\DataTables;
use App\Models\Arm_role_privilege;
use Auth;
use Crypt;
use Arr;
use Storage;

class InfographicsController extends Controller
{
    use MediaTrait;

    public  function index(){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'infographics_view')){
            return view('admin.media.infographics.infographics');
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }
 
    public function add_anfographics(){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'infographics_add')){
            $all_report = Arm_reports::where('status','active')->orderBy('id','DESC')->get();
            return view('admin.media.infographics.add_infographics', compact('all_report'));
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }

    public function store(Request $request)
    {
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        
        $id = $request->id;
        $request->validate([
            'image_path' => 'max:2048',
        ],[
            'image_path' => 'Image Must Not Be More Than 2MB'
        ]);
        if ($request->has('infographics')){
            if ($request->has('image_path')) {
                $input['image_path'] = $this->verifyAndUpload($request, 'image_path', 'images/infographics');
                $original_name = $request->file('image_path')->getClientOriginalName();
                $input['image_name'] = $original_name;
            }
            $input['title'] = $request->title;
            $input['report_id'] = $request->report_id;
        
           if (!empty($id)) {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'infographics_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_infographics::where('id', '=', $id)->update($input);
                    return redirect('/admin/infographics')->with('success', 'Updated Successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                } 
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'infographics_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_infographics::create($input);
                    return redirect('admin/infographics')->with('success', 'Added Successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                } 
            }
        }

        if ($request->has('meta')) {
            $input['meta_title'] = $request->meta_title;
            $input['meta_keyword'] = $request->meta_keyword;
            $input['meta_description'] = $request->meta_description;

            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'infographics_edit')){
                $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Arm_infographics::where('id', $id)->update($input);
                return redirect('/admin/infographics')->with('success', 'Updated Successfully!');
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            } 
        }
    }

    public function  data_table(Request $request)
    {
        $infographics= Arm_infographics::where('status', '!=', 'delete')->orderBy('id','DESC')
            ->select('id','title','report_id','image_name','image_path','status')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($infographics)
                ->addIndexColumn()

                ->addColumn('title', function ($row) {
                    if (!empty($row->title)) {
                        return ucfirst($row->title);
                    }
                })

               ->addColumn('report_url', function ($row) {
                    if (!empty($row->report_id)) {
                        $report = Arm_reports::where('status','active')->where('id', $row->report_id)->first();
                        return '<a href="' . url('/reports') . '/' . $report->url . '/' . $report->id .'" target="_blank">' . url('/reports') . '/' . $report->url . '/' . $report->id .'</a>';
                    }else{
                        return '';
                    }
                })

                ->addColumn('image_path', function ($row) {
                    return !empty($row->image_path) ? '<img src="' . url('/') . Storage::url($row->image_path) . '" alt="' . $row->image_name . '" class="table-img">' : '';
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'infographics_edit')){
                        $actionBtn .= '<a href="' . url('admin/infographics/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:;"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit" disabled><i class="fa fa-pencil"></i></button></a>';
                    }
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'infographics_delete')) {
                        $actionBtn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="arm_infographics" data-flash="Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:;" class="btn btn-danger btn-xs" title="Disabled" disabled><i class="fa fa-trash"></i></a>';
                    }
                    return $actionBtn;
                })

                ->addColumn('status', function ($row) {
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'infographics_status_change')){
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_infographics" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_infographics" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                            return $statusBlockBtn;
                        }
                    } else {
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:;" disabled ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title="Active"></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:;" disabled ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title="Inactive"></></a>';
                            return $statusBlockBtn;
                        }
                    }
                })

                ->rawColumns(['action', 'status', 'image_path','report_url'])
                ->make(true);
        }
    }


    public function edit(Request $request){
        try{
            $role_id = Auth::guard('arm_admins')->user()->role_id;
            $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'infographics_edit')){
                $infographics = Arm_infographics::where('id', Crypt::decrypt($request->id))->where('status', '!=', 'delete')->first();
                $all_report = Arm_reports::where('status','active')->orderBy('id','DESC')->get();
                return view('admin.media.infographics.add_infographics',compact('infographics', 'all_report'));
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            } 
        }
        catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect('admin/testimonial')->with('error', 'Access Denied !');
        }
        
    }
    
     public function show(){
        $infographics = Arm_infographics::where('status', 'active')->orderBy('id','DESC')->paginate(10);
        return view('front.infographics', compact('infographics'));
    }


    public function show_detail(Request $request)
    {
        $report = "";
        $infographics = Arm_infographics::where('id', $request->id)->where('status', 'active')->first();
        $recentInfographics = Arm_infographics::where('status', 'active')->orderBy('id', 'desc')->limit(3)->get();
        if(!empty($infographics->report_id)){
            $report = Arm_reports::where('status','active')->where('id', $infographics->report_id)->first();
        }
        return view('front.infographics-details', compact('infographics', 'recentInfographics', 'report'));
    }

    public function infographics_search(Request $request)
    {
        $searchText = $request->search;
        $infographics = Arm_infographics::where('status', 'active')
        ->where(function ($query) use ($searchText) {
            $query->where('title', 'like', '%' . $searchText . '%');
        })->paginate(10);
        return view('front.infographics', compact('infographics', 'searchText'));
    }

}
