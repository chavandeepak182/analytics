<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\BlogPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;
use App\Traits\MediaTrait;
use Str;


class BlogsController extends Controller
{
    use MediaTrait;

    public function index()
    {
        $blogpage = BlogPage::where('status', '!=', 'delete')
            ->select('*')
            ->first();

        return view('admin.cms.blogs.blogs', compact('blogpage'));
    }
    public function blogs_view()
    {
        $blogpage = BlogPage::where('status', '=', 'active')
            ->select('*')
            ->first();
        $blogs = Blog::where('status', '=', 'active')
            ->select('*')
           
            ->get();

        // dd($blogpage);
        return view('front/blogs', compact('blogpage', 'blogs'));

    }

    public function create()
    {
        return view('admin.cms.blogs.add-blogs');
    }

    // This function is for datatable
    public function data_table(Request $request)
    {

        $blogs = Blog::where('status', '!=', 'delete')
            ->orderBy('id', 'DESC')
            ->get();
        if ($request->ajax()) {
            return DataTables::of($blogs)
                ->addIndexColumn()
                ->addColumn('blog_description', function ($row) {
                    if (!empty($row->blog_description)) {
                        return substr(strip_tags($row->blog_description), 0, 100) . '...';
                    } else {
                        return '';
                    }
                })
                ->addColumn('blog_author', function ($row) {
                    return !empty($row->blog_author) ? ucfirst($row->blog_author) : '';
                })
                ->addColumn('blog_date', function ($row) {
                    return !empty($row->blog_date) ? date('d M Y', strtotime($row->blog_date)) : '';
                })
                ->addColumn('blog_image', function ($row) {
                    $blog_image = '<img src="' . url('/') . Storage::url($row->blog_image_path) . '" alt="' . $row->blog_image_name . '" style="height: 70px; width:90px">';
                    return $blog_image;
                })
                ->addColumn('action', function ($row) {
                    $actionBtn = ' 
                            <a href="' . url('admin/blogs/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                            <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="blogs" data-flash="Blog Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })

                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="blogs" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="blogs" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['blog_author', 'blog_date', 'blog_description', 'blog_image', 'action', 'status'])
                ->make(true);
        }
    }

    public function store(Request $request)
    {
        //checking server side validation
        $request->validate([
            'blog_title' => 'required|string',
            'blog_author' => 'required|string',
            'slug_url' => 'required|string',
            'blog_description' => 'required|string',
            'blog_date' => 'required|date',
        ]);

        $input = $request->all();
        $id = $request->txtpkey;
        if (!empty($id)) {
            // $check_id = Blog::where('id', '!=', $id)
            //     ->where('blog_title', '=', $request->blog_title)
            //     ->where('status', '!=', 'delete')
            //     ->first();
            // if (!empty($check_id)) {
            //     return redirect()->back()->with('error', 'This blog title already exists!');
            // } else {
                //update blogs
                if ($request->has('blog_image_path')) {
                    $input['blog_image_path'] = $this->verifyAndUpload($request, 'blog_image_path', 'images/blog_images');
                    $original_name = $request->file('blog_image_path')->getClientOriginalName();
                    $input['blog_image_name'] = $original_name;
                }
                // slug
                $input['blog_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $input['blog_date'])));
                // $input['slug_url'] = Str::slug($input['blog_title']);
                $input['slug_url'] = $request->slug_url;
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Blog::find($id)->update($input);
                return redirect('admin/blogs')->with('success', 'Blog updated successfully!');
            // }
        } else {
            //create blog
            $check_duplicate = Blog::where('blog_title', $request->blog_title)
                ->where('status', '!=', 'delete')
                ->get();
            if (($check_duplicate)->isEmpty()) {
                if ($request->has('blog_image_path')) {
                    $input['blog_image_path'] = $this->verifyAndUpload($request, 'blog_image_path', 'images/blog_images');
                    $original_name = $request->file('blog_image_path')->getClientOriginalName();
                    $input['blog_image_name'] = $original_name;
                }
                // slug
                $input['blog_date'] = date('Y-m-d', strtotime(str_replace('/', '-', $input['blog_date'])));
                // $input['slug_url'] = Str::slug($input['blog_title']);
                $input['slug_url'] = $request->slug_url;
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Blog::create($input);
                return redirect('admin/blogs')->with('success', 'Blog added successfully!');
            } else {
                return redirect('admin/blogs/create')->with('error', 'This blog title already exists!');
            }
        }
    }



    // This function is to check if blog title already exists or not
    // public function blog_title_exists(Request $request)
    // {

    //     $blog_title = Blogs::where('blog_title', '=', $request->blog_title)
    //         ->where('status', '!=', 'delete')
    //         ->select('blog_title');
    //     if (!empty($request->txtpkey)) {
    //         $blog_title = $blog_title->where('id', '!=', $request->txtpkey);
    //     }
    //     $blog_title = $blog_title->first();

    //     return !empty($blog_title) ? 'false' : 'true';
    // }

    public function edit($id)
    {
        $id = Crypt::decrypt($id);
        // print_r();
        // die();
        // $blog = Blogs::where('id', '=', $id)
        //     ->select('id', 'blog_title', 'blog_author', 'blog_date', 'blog_description', 'slug_url', 'blog_image_path', 'blog_image_name')
        //     ->first();
        $blog = Blog::where('id', '=', $id)
            ->select('*')
            ->first();
        // dd($blog);
        return view('admin.cms.blogs.add-blogs', compact('blog'));
    }
    public function blog_view_content($id)
    {
       
        // $name = str_replace('-', ' ', $id);
        // dd(''.$id.'');

        // $blog = Blogs::where('id', '=', $id)
        //     ->select('id', 'blog_title', 'blog_author', 'blog_date', 'blog_description', 'slug_url', 'blog_image_path', 'blog_image_name')
        //     ->first();
        $name = $id;
        $blog = Blog::where('slug_url', '=', $name)
            ->select('*')
            ->first();
        $blogs = Blog::where('status', '=', 'active')
        ->where('slug_url', '!=', $name)
            ->orderBy('created_at', 'desc')
            ->limit(10)
            ->get();
        $blog_page = BlogPage::where('status', '=', 'active')
            ->select('*')
            ->first();
        // dd($blogs);
        if ($blog) {
            return view('front/blog-view', compact('blog', 'blogs', 'blog_page'));
        } else {
            return redirect('/blogs');

        }
    }

    public function blog_page(Request $request)
    {
        // dd($request);

        $id = $request->txtpkey;

        if ($request->has('submit_blog_banner')) {
            $request->validate([
                'blog_heading' => 'required',
                'blog_description' => 'required',
            ], [
                'blog_heading' => 'Heading is Required',
                'blog_description' => 'Description is Required',
            ]);
            if ($request->has('blog_banner_image_path')) {
                $request->validate([
                    'blog_banner_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'blog_banner_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'blog_banner_image_path.required' => 'Image is Required',
                ]);
                $input['blog_banner_image_path'] = $this->verifyAndUpload($request, 'blog_banner_image_path', 'images/blog');
                $original_name = $request->file('blog_banner_image_path')->getClientOriginalName();
                $input['blog_banner_image_name'] = $original_name;
            }
            $input['blog_heading'] = $request->blog_heading;
            $input['blog_description'] = $request->blog_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                BlogPage::where('id', '=', $id)->update($input);
                return redirect('/admin/blogs')->with('success', 'Blog page updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                BlogPage::create($input);
                return redirect('/admin/blogs')->with('success', 'Blog page added successfully!');
            }
        }
        if ($request->has('submit_blog_main')) {
            $request->validate([
                'blog_main_heading' => 'required',
                'blog_main_description' => 'required',
            ], [
                'blog_main_heading' => 'Heading is Required',
                'blog_main_description' => 'Description is Required',
            ]);

            $input['blog_main_heading'] = $request->blog_main_heading;
            $input['blog_main_description'] = $request->blog_main_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                BlogPage::where('id', '=', $id)->update($input);
                return redirect('/admin/blogs')->with('success', 'Blog page updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                BlogPage::create($input);
                return redirect('/admin/blogs')->with('success', 'Blog page added successfully!');
            }
        }
        $request->validate([
            'blog_small_heading' => 'required',
        ], [
            'blog_small_heading' => 'Heading is Required',
        ]);
        if ($request->has('blog_small_image_path')) {
            $request->validate([
                'blog_small_image_path' => "mimes:jpg,png,jpeg|required",
            ], [
                'blog_small_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                'blog_small_image_path.required' => 'Image is Required',
            ]);
            $input['blog_small_image_path'] = $this->verifyAndUpload($request, 'blog_small_image_path', 'images/blogs');
            $original_name = $request->file('blog_small_image_path')->getClientOriginalName();
            $input['blog_small_image_name'] = $original_name;
        }
        $input['blog_small_heading'] = $request->blog_small_heading;

        if (!empty($id)) {
            $input['modified_by'] = auth()->guard('admin')->user()->id;
            $input['modified_ip_address'] = $request->ip();
            BlogPage::where('id', '=', $id)->update($input);
            return redirect('/admin/blogs')->with('success', 'Blog page updated successfully!');
        } else {
            $input['created_by'] = auth()->guard('admin')->user()->id;
            $input['created_ip_address'] = $request->ip();
            BlogPage::create($input);
            return redirect('/admin/blogs')->with('success', 'Blog page added successfully!');
        }
    }

}
