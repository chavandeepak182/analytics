<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\LandingAboutUs;
use App\Models\LandingContactUs;
use App\Models\LandingFooter;
use App\Models\LandingOurServices;
use App\Models\LandingPageHeader;
use App\Models\LandingTestimonials;
use Illuminate\Http\Request;
use App\Traits\MediaTrait;
use Crypt;
use DataTables;
use Storage;
class LandingPageController extends Controller
{
    use MediaTrait;
    /**
     * Display a listing of the resource.
     */
     
    public function front_landing_index()
    {
        //

        $head=LandingPageHeader::where('status','active')->first();
        $aboutus=LandingAboutUs::where('status','active')->first();
        $footer=LandingFooter::where('status','active')->first();
        $our=LandingOurServices::where('status','active')->get();
        $test=LandingTestimonials::where('status','active')->get();


        
        return view('front/landing-page', compact('head','aboutus','footer','our','test'));

    }
    
     public function index()
    {
        //
        

      

        $head=LandingPageHeader::where('status','active')->first();
        $aboutus=LandingAboutUs::where('status','active')->first();
        $footer=LandingFooter::where('status','active')->first();


        return view('admin/landing-page/landing-page', compact('head','aboutus','footer'));

    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request);
      
        // $request->validate([
        //     'heading_card' => 'required',
        //     'description_card' => 'required',
        // ], [
        //     'heading_card' => 'Heading is Required',
        //     'description_card' => 'Description is Required',
        // ]);

        if ($request->has('landing_head')) {
            $id = $request->headid;
        if ($request->has('head_image_path')) {
           
            // $request->validate([
            //     'head_image_path' => "mimes:jpg,png,jpeg|required",
            // ], [
            //     'card_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
            //     'card_image_path.required' => 'Image is Required',
            // ]);
            $input['image_path'] = $this->verifyAndUpload($request, 'head_image_path', 'images/LandingPageHeading');
            $original_name = $request->file('head_image_path')->getClientOriginalName();
            $input['image_name'] = $original_name;
        }
        $input['heading'] = $request->section_1_heading;
        $input['discription'] = $request->section_1_description;
        $input['landing_slug'] = $request->landing_slug;
        $input['button_name'] = $request->button_name;
        $input['button_url'] = $request->button_url;
        $input['offer_heading'] = $request->offer_heading;
        $input['offer_code'] = $request->offrt_code;
        // $input['landing_slug'] = $request->slug;

        if (!empty($id)) {
            $input['modified_by'] = auth()->guard('admin')->user()->id;
            $input['modified_ip_address'] = $request->ip();
            LandingPageHeader::where('id', '=', $id)->update($input);
            return redirect('/admin/landing-page')->with('success', 'Heading updated successfully!');
        } else {
            $input['created_by'] = auth()->guard('admin')->user()->id;
            $input['created_ip_address'] = $request->ip();
            LandingPageHeader::create($input);
            return redirect('/admin/landing-page')->with('success', 'Heading  added successfully!');
        }
    }
    if ($request->has('about_submit')) {
           
        $id = $request->eid;
         
        $input['heading'] = $request->about_heading;
        $input['discription'] = $request->about_description;
       
        if (!empty($id)) {
            $input['modified_by'] = auth()->guard('admin')->user()->id;
            $input['modified_ip_address'] = $request->ip();
            LandingAboutUs::where('id', '=', $id)->update($input);
            return redirect('/admin/landing-page')->with('success', 'About us  updated successfully!');
        } else {
            $input['created_by'] = auth()->guard('admin')->user()->id;
            $input['created_ip_address'] = $request->ip();
            LandingAboutUs::create($input);
            return redirect('/admin/landing-page')->with('success', 'About us  added successfully!');
        }
    }

    if ($request->has('titlesubmit')) {
     
        $id = $request->id;
         
        $input['our_services'] = $request->our_service_title;
        
        if (!empty($id)) {
            $input['modified_by'] = auth()->guard('admin')->user()->id;
            $input['modified_ip_address'] = $request->ip();
            LandingPageHeader::where('id', '=', $id)->update($input);
            return redirect('/admin/landing-page')->with('success', 'title  added successfully!');
        }
    }
    if ($request->has('our_service')) {
        $id = $request->ourservid;

        // $request->validate([
        //     'head_image_path' => "mimes:jpg,png,jpeg|required",
        // ], [
        //     'card_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
        //     'card_image_path.required' => 'Image is Required',
        // ]);
        if($request->has('our_service_image_path')){
        $input['image_path'] = $this->verifyAndUpload($request, 'our_service_image_path', 'images/Landingourservices');
        $original_name = $request->file('our_service_image_path')->getClientOriginalName();
        $input['image_name'] = $original_name;
    }
    $input['heading'] = $request->our_heading;
    $input['discription'] = $request->our_description;
    $input['service_slug'] = $request->service_slug;
  

    if (!empty($id)) {
        $input['modified_by'] = auth()->guard('admin')->user()->id;
        $input['modified_ip_address'] = $request->ip();
        LandingOurServices::where('id', '=', $id)->update($input);
        return redirect('/admin/landing-page')->with('success', 'services updated successfully!');
    } else {
        $input['created_by'] = auth()->guard('admin')->user()->id;
        $input['created_ip_address'] = $request->ip();
        LandingOurServices::create($input);
        return redirect('/admin/landing-page')->with('success', 'services  added successfully!');
    }
}
    if ($request->has('testimonial')) {
        $id = $request->testsid;

        // $request->validate([
        //     'head_image_path' => "mimes:jpg,png,jpeg|required",
        // ], [
        //     'card_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
        //     'card_image_path.required' => 'Image is Required',
        // ]);
        if($request->has('test_image_path')){
        $input['image_path'] = $this->verifyAndUpload($request, 'test_image_path', 'images/LandingTestimonials');
        $original_name = $request->file('test_image_path')->getClientOriginalName();
        }
     $input['heading'] = $request->test_heading;
    $input['sub_heading'] = $request->test_subheading;
    $input['discription'] = $request->test_description;
  

    if (!empty($id)) {
        $input['modified_by'] = auth()->guard('admin')->user()->id;
        $input['modified_ip_address'] = $request->ip();
        LandingTestimonials::where('id', '=', $id)->update($input);
        return redirect('/admin/landing-page')->with('success', 'testimonial updated successfully!');
    } else {
        $input['created_by'] = auth()->guard('admin')->user()->id;
        $input['created_ip_address'] = $request->ip();
        LandingTestimonials::create($input);
        return redirect('/admin/landing-page')->with('success', 'testimonial  added successfully!');
    }
}
if ($request->has('footer')) {
  
    $id =$request->footerid;
    $input['e_mail'] = $request->mail;
    $input['contact'] = $request->contact;
    $input['address'] = $request->address;
    $input['facebook_link'] = $request->facebook;
    $input['twitter_link'] = $request->twitter;
    $input['linkedin_link'] = $request->linkedin;
    $input['instagram_link'] = $request->instagram;

    if (!empty($id)) {
        $input['modified_by'] = auth()->guard('admin')->user()->id;
        $input['modified_ip_address'] = $request->ip();
        LandingFooter::where('id', '=', $id)->update($input);
        return redirect('/admin/landing-page')->with('success', 'footer updated successfully!');
    } else {
        $input['created_by'] = auth()->guard('admin')->user()->id;
        $input['created_ip_address'] = $request->ip();
        LandingFooter::create($input);
        return redirect('/admin/landing-page')->with('success', 'footer  added successfully!');
    }
}
    if ($request->has('meta')) {

    $id = $request->id;

    $input['meta_discription'] = $request->metadecription;
    $input['meta_keyword'] = $request->metakeyword;
    $input['meta_title'] = $request->metatitle;

    if (!empty($id)) {
        $input['modified_by'] = auth()->guard('admin')->user()->id;
        $input['modified_ip_address'] = $request->ip();
        LandingPageHeader::where('id', '=', $id)->update($input);
        return redirect('/admin/landing-page')->with('success', 'Meta Data  updated successfully!');
    }
}

    }

    
    public function data_table(Request $request)
    {
        //
        
        $services = LandingOurServices::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($services)
                ->addIndexColumn()
                ->addColumn('heading', function ($row) {
                    if (!empty($row->heading)) {
                        return $row->heading;
                    } else {
                        return '';
                    }
                })

                ->addColumn('discription', function ($row) {
                    return !empty($row->discription) ? $row->discription : '';
                })

                ->addColumn('image_path', function ($row) {
                    if (!empty($row->image_path)) {
                        // return '<img src="'$row->image_path_1'">';
                        return !empty($row->image_path) ? '<img src="' .$row->image_path . '" class="table-img">' : '';

                    }
                })


                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/service/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="landing_our_service" data-flash="Blog Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="landing_our_service" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="landing_our_service" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['heading', 'discription', 'image_path', 'status', 'action'])
                ->make(true);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
     
        $d=Crypt::decrypt($id);
        $ourservices=LandingOurServices::where('status','active')->where('id',$d)->first();
        $head=LandingPageHeader::where('status','active')->first();
        $aboutus=LandingAboutUs::where('status','active')->first();
        return view('admin/landing-page/landing-page', compact('ourservices','head','aboutus'));
    }


    public function testimonial_data_table(Request $request)
    {
        //
        
        $services = LandingTestimonials::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($services)
                ->addIndexColumn()
                ->addColumn('heading', function ($row) {
                    if (!empty($row->heading)) {
                        return $row->heading;
                    } else {
                        return '';
                    }
                })
                ->addColumn('sub_heading', function ($row) {
                    if (!empty($row->sub_heading)) {
                        return $row->sub_heading;
                    } else {
                        return '';
                    }
                })

                ->addColumn('discription', function ($row) {
                    return !empty($row->discription) ? $row->discription : '';
                })

                ->addColumn('image_path', function ($row) {
                    if (!empty($row->image_path)) {
                        // return '<img src="'$row->image_path_1'">';
                        return !empty($row->image_path) ? '<img src="' .$row->image_path . '" class="table-img">' : '';

                    }
                })


                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/testimonial/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="landing_testimonial" data-flash="Blog Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="landing_testimonial" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="landing_testimonial" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['heading', 'discription', 'image_path', 'status', 'action'])
                ->make(true);
        }
    }

    public function testimonial_edit(string $id)
    {
        //
     
        $d=Crypt::decrypt($id);
        $head=LandingPageHeader::where('status','active')->first();
        $aboutus=LandingAboutUs::where('status','active')->first();
        $test=LandingTestimonials::where('status','active')->where('id',$d)->first();

        return view('admin/landing-page/landing-page', compact('test','head','aboutus'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function StoreContact(Request $request)
    {
        $request->validate([
            'captcha_form' => 'required|captcha',
        ],[
            'captcha_form.captcha' => 'Please Enter Correct Capcha',
        ]);
        // dd($request->all());
        if($request){
            $input['name']=$request->name;
            $input['e_mail']=$request->email;
            $input['contact']=$request->contact;
            $input['message']=$request->message;
            $input['created_ip_address'] = $request->ip();
            if(LandingContactUs::create($input)){
                return redirect()->back()->with('success','Message send successfully!');
            }else{
                return redirect()->back()->with('error','Somthing Went Wrong!');
            }
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
    public function front_landing_slug($id)
    {
        //
        


        $head=LandingPageHeader::where('status','active')->first();
       
        if($head->landing_slug == $id){
        $aboutus=LandingAboutUs::where('status','active')->first();
        $footer=LandingFooter::where('status','active')->first();
        $our=LandingOurServices::where('status','active')->get();
        $test=LandingTestimonials::where('status','active')->get();
         return view('front/landing-page', compact('head','aboutus','footer','our','test'));
        }else{
            
return redirect('/')->with('error', 'not found!');

        }


        
       

    }
}
