<?php

namespace App\Http\Controllers\Admin\Blogs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Arm_blog;
use App\Models\Arm_reports;
use App\Traits\MediaTrait;
use Yajra\DataTables\DataTables;
use App\Models\Arm_role_privilege;
use Auth;
use Crypt;
use Arr;
use Storage;


class BlogController extends Controller
{
    use MediaTrait;
   
    public function index(){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'blog_press_release_view')){
            return view('admin.media.blogs.blogs');
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }
    
    public function add_blogs(){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'blog_press_release_add')){
            $all_report = Arm_reports::where('status','active')->orderBy('id','DESC')->take(500)->get();
            return view('admin.media.blogs.add_blogs', compact('all_report'));
        } else {
            return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
        } 
    }

    public function store(Request $request){
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
        
        $id = $request->id;
        if ($request->has('blog')){
            $request->validate([
                'image_path' => 'max:2048',
                'slug_url' => 'required|max:255'
            ],[
                'image_path' => 'Image Must Not Be More Than 2MB'
            ]);
            if ($request->has('image_path')) {
                $input['image_path'] = $this->verifyAndUpload($request, 'image_path', 'images/blogs');
                $original_name = $request->file('image_path')->getClientOriginalName();
                $input['image_name'] = $original_name;
            }
            $input['type'] = $request->page_type;
            $input['title'] = $request->title;
            if(!Arm_blog::where('status', '!=', 'delete')->where('id', '!=', $id)->where('type', $request->page_type)->where('slug_url', $request->slug_url)->exists()){
                $input['slug_url'] = Str::slug($request->slug_url);
            } else {
                return redirect()->back()->with('error', 'Slug Url Already Exists');
            }
            $input['report_id'] = $request->report_id;
            $input['auther'] = !empty($request->auther)?$request->auther:null;
            $input['published_on'] = $request->date;
            $input['description'] = $request->description;
        
            if(!empty($id)){
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'blog_press_release_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_blog::where('id', '=', $id)->update($input);
                    return redirect('/admin/blogs')->with('success', 'Blog updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                } 
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'blog_press_release_add')){
                    $input['created_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['created_ip_address'] = $request->ip();
                    Arm_blog::create($input);
                    return redirect('/admin/blogs')->with('success', 'Blog added successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                } 
            }
        }
          
        if ($request->has('meta')){
            
            $input['meta_title'] = $request->meta_title;
            $input['meta_keyword'] = $request->meta_keyword;
            $input['meta_description'] = $request->meta_description;
            if(!empty($id)){
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'blog_press_release_edit')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_blog::where('id', '=', $id)->update($input);
                    return redirect('/admin/blogs')->with('success', 'Blog Meta Details updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                } 
            } else {
                if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'blog_press_release_add')){
                    $input['modified_by'] = auth()->guard('arm_admins')->user()->id;
                    $input['modified_ip_address'] = $request->ip();
                    Arm_blog::create($input);
                    return redirect('/admin/blogs')->with('success', 'Blog Meta Details updated successfully!');
                } else {
                    return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
                } 
            }
        }
    }

    public function  blog_data_table(Request $request)
    {
        $blog= Arm_blog::where('status', '!=', 'delete')->orderBy('id', 'DESC');
        if($request->has('page_type') && !empty($request->page_type)){
            $blog = $blog->where('type', $request->page_type);
        }
        $blog = $blog->select('id','title','type','description', 'published_on','image_path','image_name','status')->get();

        if ($request->ajax()){
            return DataTables::of($blog)
                ->addIndexColumn()

                ->addColumn('tile', function ($row){
                    if (!empty($row->title)) {
                        return ucfirst($row->contenttitle);
                    }
                })
                ->addColumn('type', function ($row){
                    if (!empty($row->type)) {
                        return $row->type == "press_release" ? 'Press Release' : 'Blog';
                    }
                })

                ->addColumn('description', function ($row) {
                    if (!empty($row->description)) {
                        return substr(strip_tags($row->description), 0, 100) . '...';
                    }
                })

                ->addColumn('published_on', function ($row) {
                    if (!empty($row->published_on)) {
                        $published_on = date('d-m-Y',strtotime($row->published_on));
                        return ucfirst($published_on);
                    }
                })
                    
                ->addColumn('image_path', function ($row){
                    return !empty($row->image_path) ? '<img src="' . url('/') . Storage::url($row->image_path) . '" alt="' . $row->image_name . '" class="table-img">' : '';
                })

                ->addColumn('action', function ($row) {
                    $actionBtn = '';
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'blog_press_release_edit')){
                        $actionBtn .= '<a href="' . url('admin/blog/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:;"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit" disabled><i class="fa fa-pencil"></i></button></a>';
                    }
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'blog_press_release_delete')) {
                        $actionBtn .= '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="arm_blogs" data-flash="Blog Or Press Release Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    } else {
                        $actionBtn .= '<a href="javascript:;" class="btn btn-danger btn-xs" title="Disabled" disabled><i class="fa fa-trash"></i></a>';
                    }
                    return $actionBtn;
                })

                ->addColumn('status', function ($row) {
                    $role_id = Auth::guard('arm_admins')->user()->role_id;
                    $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
                    if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'blog_press_release_edit')){
                        if ($row->status == 'active') {
                            $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_blogs" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                            return $statusActiveBtn;
                        } else {
                            $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="arm_blogs" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
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

                ->rawColumns(['action','status','image_path'])
                ->make(true);
        }
    }

    public function edit(Request $request){
        try{
            $role_id = Auth::guard('arm_admins')->user()->role_id;
            $RolesPrivileges = Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
            if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'blog_press_release_edit')){
                $blog = Arm_blog::where('id', Crypt::decrypt($request->id))->first();
                $all_report = Arm_reports::where('status','active')->orderBy('id','DESC')->get();
                return view('admin.media.blogs.add_blogs',compact('blog','all_report'));
            } else {
                return redirect()->back()->with('error', 'Sorry, You Have No Permission For This Request!');
            } 
        }
        catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return redirect('admin/testimonial')->with('error', 'Access Denied !');
        }
    }

    public function show_blogs(Request $request){
        if(!empty($request->slug_url)){
            $blog_details = Arm_blog::where('status', 'active')->where('type', 'blogs')->where('slug_url', $request->slug_url)->first();
            if(empty($blog_details)){
                return redirect('/404');
            }
            $recentBlogs = Arm_blog::where('type', 'blogs')->where('status', 'active')->orderBy('id', 'DESC')->limit(5)->get();
            $report = Arm_reports::where('status','active')->where('id', $blog_details->report_id)->first();
            if(empty($report)){
                $report = "";
            }
            return view('front.blog-details',compact('blog_details', 'recentBlogs', 'report'));
        }
        $blogs = Arm_blog::where('type', 'blogs')->where('status', 'active')->orderBy('id', 'DESC')->get();
        return view('front.blogs',compact('blogs'));
    }

    // public function show_blog_details(Request $request){
    //     $report = "";
    //     $id = $request->id;
    //     $blog_details = Arm_blog::where('id', '=',$id)->first();
    //     $recentBlogs = Arm_blog::where('type', 'blogs')->where('status', 'active')->orderBy('id', 'DESC')->limit(5)->get();
    //     if(!empty($blog_details->report_id)){
    //         $report = Arm_reports::where('status','active')->where('id', $blog_details->report_id)->first();
    //     }
    //     return view('front.blog-details',compact('blog_details', 'recentBlogs', 'report'));
    // }

    public function show_press_releases(Request $request)
    {
        if(!empty($request->slug_url)){
            $press_release = Arm_blog::where('status', 'active')->where('type', 'press_release')->where('slug_url', $request->slug_url)->first();
            if(empty($press_release)){
                return redirect('/404');
            }
            return view('front.press-release-view', compact('press_release'));
        }
        $pressReleases = Arm_blog::where('type','=','press_release')->where('status', '=', 'active')->orderBy('id', 'DESC')->get();
        return view('front.press-release', compact('pressReleases'));
    }

    // public function show_press_release_details(Request $request)
    // {
    //     $press_release = Arm_blog::where('slug_url', $request->slug_url)->first();
    //     return view('front.press-release-view', compact('press_release'));
    // }

    public function search_press_releases(Request $request)
    {
        $searchQuery = $request->search;
        $page = request()->query('page', 1);
        $perPage = 5;
        $query = Arm_blog::query();
        $query->where('type', '=', 'press_release');

        if ($searchQuery) {
            $query->where(function ($q) use ($searchQuery) {
                $q->where('title', 'like', '%' . $searchQuery . '%')
                    ->orWhere('description', 'like', '%' . $searchQuery . '%')
                    ->orWhere('published_on', 'like', '%' . $searchQuery . '%');
            });
        }

        $blogsByYear = $query->selectRaw('YEAR(published_on) as year, COUNT(*) as count')
        ->groupBy('year')
        ->orderBy('year', 'DESC')
        ->paginate($perPage, ['*'], 'page', $page);

        $groupedBlogs = [];
        foreach ($blogsByYear->items() as $blogData) {
            $year = $blogData->year;
            $queryForYear = Arm_blog::where('type', '=', 'press_release')
            ->whereYear('published_on', $year);

            if ($searchQuery) {
                $queryForYear->where(function ($q) use ($searchQuery) {
                    $q->where('title', 'like', '%' . $searchQuery . '%')
                        ->orWhere('description', 'like', '%' . $searchQuery . '%')
                        ->orWhere('published_on', 'like', '%' . $searchQuery . '%');
                });
            }

            $groupedBlogs[$year] = $queryForYear->orderBy('published_on', 'DESC')->get();
        }
        return view('front.press-release', compact('groupedBlogs', 'blogsByYear', 'searchQuery'));
    }

    public function check_blog_slug_url_exist(Request $request){
        return Arm_blog::where('status', '!=', 'delete')->where('id', '!=', $request->blog_id)->where('type', $request->page_type)->where('slug_url', $request->slug_url)->exists();
    }
}
