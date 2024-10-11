<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StratergicBanner;
use App\Models\StratergicAboutus;
use App\Models\StratergicCard;
use App\Models\StratergicCardthree;
use App\Models\StratergicsmallBanner;
use App\Traits\MediaTrait;
use Yajra\DataTables\DataTables;

use App\Models\CustomBanner;
use App\Models\CustomAboutUs;
use App\Models\CustomCard;
use App\Models\CustomCardFour;
use App\Models\CustomCardThree;
use App\Models\CustomSmallBanner;
use Crypt;

use App\Models\DigitalBanner;
use App\Models\DigitalAbout;
use App\Models\DigitalCard;
use App\Models\DigitalCardThree;
use App\Models\DigitalSmallBanner;

use App\Models\AppBanner;
use App\Models\Appcard;
use App\Models\AppcardThree;
use App\Models\Appcardtwo;
use App\Models\AppSmallBanner;

class ServicesController extends Controller
{
    use MediaTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $banner = StratergicBanner::where('status', 'active')->first();
        $about = StratergicAboutus::where('status', 'active')->first();
        $smallbanner = StratergicsmallBanner::where('status', '!=', 'delete')->first();

        return view('admin/cms/services/strategic_consulting', compact('banner', 'about', 'smallbanner'));
    }

    public function custom_index()
    {

        $banner = CustomBanner::where('status', 'active')->first();
        $about = CustomAboutUs::where('status', 'active')->first();
        $smallbanner = CustomSmallBanner::where('status', '!=', 'delete')->first();

        return view('admin/cms/services/custom_development', compact('banner', 'about', 'smallbanner'));

    }
    public function digital_index()
    {

        $banner = DigitalBanner::first();
        $about = DigitalAbout::where('status', 'active')->first();
        $smallbanner = DigitalSmallBanner::where('status', '!=', 'delete')->first();

        return view('admin/cms/services/digital_marketing', compact('banner', 'about', 'smallbanner'));

    }
    public function App_developement_index()
    {

        $banner = AppBanner::first();

         $card2_count=Appcardtwo::where('status','!=','delete')->count();
        $smallbanner = AppSmallBanner::where('status', '!=', 'delete')->first();
// dd($card2_count);
        return view('admin/cms/services/mobile_app_development', compact('banner', 'smallbanner','card2_count'));

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
        //
        // dd($request);

        $id = $request->txtpkey;
        if ($request->has('submit-banner')) {
            $request->validate([
                'heading' => 'required',
                'description' => 'required',
            ], [
                'heading' => 'Heading is Required',
                'description' => 'Description is Required',
            ]);
            if ($request->has('banner_image_path')) {
                $request->validate([
                    'banner_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'banner_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'banner_image_path.required' => 'Image is Required',
                ]);
                $input['banner_image_path'] = $this->verifyAndUpload($request, 'banner_image_path', 'images/StrategicBanner');
                $original_name = $request->file('banner_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->heading;
            $input['description'] = $request->description;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                StratergicBanner::where('id', '=', $id)->update($input);
                return redirect('/admin/strategic-consulting')->with('success', 'Banner  updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                StratergicBanner::create($input);
                return redirect('/admin/strategic-consulting')->with('success', 'Banner  added successfully!');
            }
        }
        if ($request->has('about_section')) {

            $aboutid = $request->aboutid;
            $request->validate([
                'headingabout' => 'required',
                'descriptionabout' => 'required',
            ], [
                'headingabout' => 'Heading is Required',
                'descriptionabout' => 'Description is Required',
            ]);

            if ($request->has('about_image_path_1')) {
                $request->validate([
                    'about_image_path_1' => "mimes:jpg,png,jpeg|required",
                ], [
                    'about_image_path_1.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'about_image_path_1.required' => 'Image is Required',
                ]);
                $input['image_path_1'] = $this->verifyAndUpload($request, 'about_image_path_1', 'images/Strategicabout');
                $original_name = $request->file('about_image_path_1')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            if ($request->has('about_image_path_2')) {
                $request->validate([
                    'about_image_path_2' => "mimes:jpg,png,jpeg|required",
                ], [
                    'about_image_path_2.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'about_image_path_2.required' => 'Image is Required',
                ]);
                $input['image_path_2'] = $this->verifyAndUpload($request, 'about_image_path_2', 'images/Strategicabout');
                $original_name = $request->file('about_image_path_2')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            if ($request->has('about_image_path_3')) {
                $request->validate([
                    'about_image_path_3' => "mimes:jpg,png,jpeg|required",
                ], [
                    'about_image_path_3.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'about_image_path_3.required' => 'Image is Required',
                ]);
                $input['image_path_3'] = $this->verifyAndUpload($request, 'about_image_path_3', 'images/Strategicabout');
                $original_name = $request->file('about_image_path_3')->getClientOriginalName();
            }
            $input['heading'] = $request->headingabout;
            $input['description'] = $request->descriptionabout;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($aboutid)) {

                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();

                StratergicAboutus::where('id', '=', $aboutid)->update($input);
                return redirect('/admin/strategic-consulting')->with('success', 'About section  updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();

                StratergicAboutus::create($input);
                return redirect('/admin/strategic-consulting')->with('success', 'About section  added successfully!');
            }

        }

        if ($request->has('head-submit')) {
            $headid = $request->id;

            $request->validate([
                'Headingsec2' => 'required',
                'Headingsub2' => 'required',
            ], [
                'Headingsec2' => 'Heading is Required',
                'Headingsub2' => 'Sub heading is Required',
            ]);
            $input['section2_heading'] = $request->Headingsec2;
            $input['section2_subheading'] = $request->Headingsub2;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($headid)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                StratergicBanner::where('id', '=', $headid)->update($input);
                return redirect('/admin/strategic-consulting')->with('success', 'Heading updated successfully!');
            }

        }
        if ($request->has('cards-submit')) {

            $cardid = $request->cardid;
            $request->validate([
                'heading_card' => 'required',
                'description_card' => 'required',
            ], [
                'heading_card' => 'Heading is Required',
                'description_card' => 'Description is Required',
            ]);
            if ($request->has('card_image_path')) {
                $request->validate([
                    'card_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'card_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'card_image_path.required' => 'Image is Required',
                ]);
                $input['image_path_1'] = $this->verifyAndUpload($request, 'card_image_path', 'images/StrategiCards');
                $original_name = $request->file('card_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->heading_card;
            $input['discription'] = $request->description_card;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($cardid)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                StratergicCard::where('id', '=', $cardid)->update($input);
                return redirect('/admin/strategic-consulting')->with('success', 'Card  updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                StratergicCard::create($input);
                return redirect('/admin/strategic-consulting')->with('success', 'Card  added successfully!');
            }

        }
        if ($request->has('head-submit3')) {
            $headid = $request->id;

            $request->validate([
                'heading3' => 'required',
                'subheading3' => 'required',
            ], [
                'heading3' => 'Heading is Required',
                'subheading3' => 'Sub heading is Required',
            ]);
            $input['section3_heading'] = $request->heading3;
            $input['section3_subheading'] = $request->subheading3;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($headid)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                StratergicBanner::where('id', '=', $headid)->update($input);
                return redirect('/admin/strategic-consulting')->with('success', 'Heading updated successfully!');
            }

        }
        if ($request->has('card3-submit')) {
            //  dd($request);
            $id = $request->id;
            $request->validate([
                'headingcard3' => 'required',
                //'descriptioncard3' => 'required',
            ], [
                'headingcard3' => 'Heading is Required',
                //'descriptioncard3' => 'Description is Required',
            ]);
            if ($request->has('card3_image_path')) {
                $request->validate([
                    'card3_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'card3_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'card3_image_path.required' => 'Image is Required',
                ]);
                $input['image_path_1'] = $this->verifyAndUpload($request, 'card3_image_path', 'images/StrategicBanner');
                $original_name = $request->file('card3_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->headingcard3;
            // $input['description'] = $request->description;   
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                StratergicCardthree::where('id', '=', $id)->update($input);
                return redirect('/admin/strategic-consulting')->with('success', 'Card  updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                StratergicCardthree::create($input);
                return redirect('/admin/strategic-consulting')->with('success', 'Card  added successfully!');
            }

        }
        if ($request->has('submit-small-banner')) {
            //  dd($request);
            $id = $request->id;
            $request->validate([
                'headingsmall' => 'required',
                //'descriptioncard3' => 'required',
            ], [
                'headingsmall' => 'Heading is Required',
                //'descriptioncard3' => 'Description is Required',
            ]);
            if ($request->has('smallbanner_image_path')) {
                $request->validate([
                    'smallbanner_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'smallbanner_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'smallbanner_image_path.required' => 'Image is Required',
                ]);
                $input['banner_image_path'] = $this->verifyAndUpload($request, 'smallbanner_image_path', 'images/StrategicBanner');
                $original_name = $request->file('smallbanner_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->headingsmall;
            // $input['description'] = $request->description;   
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                StratergicsmallBanner::where('id', '=', $id)->update($input);
                return redirect('/admin/strategic-consulting')->with('success', 'Banner  updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                StratergicsmallBanner::create($input);
                return redirect('/admin/strategic-consulting')->with('success', 'Banner  added successfully!');
            }

        }
        


    }
    

    public function meta_storestr(Request $request)
    {
       
        $id = $request->id;

        $input['meta_discription'] = $request->metadecription;
        $input['meta_keyword'] = $request->metakeyword;
        $input['meta_title'] = $request->metatitle;

        if (!empty($id)) {
            $input['modified_by'] = auth()->guard('admin')->user()->id;
            $input['modified_ip_address'] = $request->ip();
            StratergicBanner::where('id', '=', $id)->update($input);
            return redirect('/admin/strategic-consulting')->with('success', 'Meta Data  updated successfully!');
    }
}

public function meta_storedigi(Request $request)
    {
       
            $id = $request->id;

            $input['meta_discription'] = $request->metadecription;
            $input['meta_keyword'] = $request->metakeyword;
            $input['meta_title'] = $request->metatitle;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                DigitalBanner::where('id', '=', $id)->update($input);
                return redirect('/admin/digital-marketing')->with('success', 'Meta Data  updated successfully!');
            }

}
public function meta_storeapp(Request $request)
    {
       
            $id = $request->id;

            $input['meta_discription'] = $request->metadecription;
            $input['meta_keyword'] = $request->metakeyword;
            $input['meta_title'] = $request->metatitle;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                AppBanner::where('id', '=', $id)->update($input);
                return redirect('/admin/mobile-app-development')->with('success', 'Meta Data  updated successfully!');
            }

}
public function meta_storecust(Request $request)
    {
            $id = $request->id;
            $input['meta_discription'] = $request->metadecription;
            $input['meta_keyword'] = $request->metakeyword;
            $input['meta_title'] = $request->metatitle;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                CustomBanner::where('id', '=', $id)->update($input);
                return redirect('/admin/custom-development')->with('success', 'Meta Data  updated successfully!');
            }

}
    public function Custom_store(Request $request)
    {
        //
        // dd($request);


        $id = $request->txtpkey;
        if ($request->has('submit-banner')) {
            $request->validate([
                'heading' => 'required',
                'description' => 'required',
            ], [
                'heading' => 'Heading is Required',
                'description' => 'Description is Required',
            ]);
            if ($request->has('banner_image_path')) {
                $request->validate([
                    'banner_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'banner_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'banner_image_path.required' => 'Image is Required',
                ]);
                $input['banner_image_path'] = $this->verifyAndUpload($request, 'banner_image_path', 'images/CustomBanner');
                $original_name = $request->file('banner_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->heading;
            $input['description'] = $request->description;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                CustomBanner::where('id', '=', $id)->update($input);
                return redirect('/admin/custom-development')->with('success', 'Banner updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                CustomBanner::create($input);
                return redirect('/admin/custom-development')->with('success', 'Banner added successfully!');
            }
        }
        if ($request->has('about_section')) {

            $aboutid = $request->aboutid;
            $request->validate([
                'headingabout' => 'required',
                'descriptionabout' => 'required',
            ], [
                'headingabout' => 'Heading is Required',
                'descriptionabout' => 'Description is Required',
            ]);

            if ($request->has('about_image_path_1')) {
                $request->validate([
                    'about_image_path_1' => "mimes:jpg,png,jpeg|required",
                ], [
                    'about_image_path_1.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'about_image_path_1.required' => 'Image is Required',
                ]);
                $input['image_path_1'] = $this->verifyAndUpload($request, 'about_image_path_1', 'images/Customabout');
                $original_name = $request->file('about_image_path_1')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            if ($request->has('about_image_path_2')) {
                $request->validate([
                    'about_image_path_2' => "mimes:jpg,png,jpeg|required",
                ], [
                    'about_image_path_2.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'about_image_path_2.required' => 'Image is Required',
                ]);
                $input['image_path_2'] = $this->verifyAndUpload($request, 'about_image_path_2', 'images/Customabout');
                $original_name = $request->file('about_image_path_2')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            if ($request->has('about_image_path_3')) {
                $request->validate([
                    'about_image_path_3' => "mimes:jpg,png,jpeg|required",
                ], [
                    'about_image_path_3.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'about_image_path_3.required' => 'Image is Required',
                ]);
                $input['image_path_3'] = $this->verifyAndUpload($request, 'about_image_path_3', 'images/Customabout');
                $original_name = $request->file('about_image_path_3')->getClientOriginalName();
            }
            $input['heading'] = $request->headingabout;
            $input['discription'] = $request->descriptionabout;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($aboutid)) {

                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();

                CustomAboutUs::where('id', '=', $aboutid)->update($input);
                return redirect('/admin/custom-development')->with('success', 'About section  updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();

                CustomAboutUs::create($input);
                return redirect('/admin/custom-development')->with('success', 'About section  added successfully!');
            }

        }

        if ($request->has('head-submit')) {
            $headid = $request->id;

            $request->validate([
                'Headingsec2' => 'required',
                'Headingsub2' => 'required',
            ], [
                'Headingsec2' => 'Heading is Required',
                'Headingsub2' => 'Sub heading is Required',
            ]);
            $input['section2_heading'] = $request->Headingsec2;
            $input['section2_subheading'] = $request->Headingsub2;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($headid)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                CustomBanner::where('id', '=', $headid)->update($input);
                return redirect('/admin/custom-development')->with('success', 'Heading updated successfully!');
            }

        }
        if ($request->has('cards-submit')) {

            $cardid = $request->cardid;
            $request->validate([
                'heading_card' => 'required',
                'description_card' => 'required',
            ], [
                'heading_card' => 'Heading is Required',
                'description_card' => 'Description is Required',
            ]);
            if ($request->has('card_image_path')) {
                $request->validate([
                    'card_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'card_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'card_image_path.required' => 'Image is Required',
                ]);
                $input['image_path_1'] = $this->verifyAndUpload($request, 'card_image_path', 'images/CustomCards');
                $original_name = $request->file('card_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->heading_card;
            $input['discription'] = $request->description_card;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($cardid)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                CustomCard::where('id', '=', $cardid)->update($input);
                return redirect('/admin/custom-development')->with('success', 'Card updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                CustomCard::create($input);
                return redirect('/admin/custom-development')->with('success', 'Card added successfully!');
            }



        }
        if ($request->has('head-submit3')) {
            $headid = $request->id;

            $request->validate([
                'heading3' => 'required',
                'subheading3' => 'required',
            ], [
                'heading3' => 'Heading is Required',
                'subheading3' => 'Sub heading is Required',
            ]);
            $input['section3_heading'] = $request->heading3;
            $input['section3_subheading'] = $request->subheading3;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($headid)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                CustomBanner::where('id', '=', $headid)->update($input);
                return redirect('/admin/custom-development')->with('success', 'Heading updated successfully!');
            }

        }
        if ($request->has('card3-submit')) {
            //  dd($request);
            $id = $request->id;
            $request->validate([
                'headingcard3' => 'required',
                //'descriptioncard3' => 'required',
            ], [
                'headingcard3' => 'Heading is Required',
                //'descriptioncard3' => 'Description is Required',
            ]);
            if ($request->has('card3_image_path')) {
                $request->validate([
                    'card3_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'card3_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'card3_image_path.required' => 'Image is Required',
                ]);
                $input['image_path_1'] = $this->verifyAndUpload($request, 'card3_image_path', 'images/CustomBanner');
                $original_name = $request->file('card3_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->headingcard3;
            // $input['description'] = $request->description;   
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                CustomCardThree::where('id', '=', $id)->update($input);
                return redirect('/admin/custom-development')->with('success', 'Card  updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                CustomCardThree::create($input);
                return redirect('/admin/custom-development')->with('success', 'Card  added successfully!');
            }

        }
        if ($request->has('submithead4')) {
            $headid = $request->id;

            $request->validate([
                'Heading4' => 'required',
                'subHeading4' => 'required',
            ], [
                'Heading4' => 'Heading is Required',
                'subHeading4' => 'Sub heading is Required',
            ]);
            $input['section4_heading'] = $request->Heading4;
            $input['section4_subheading'] = $request->subHeading4;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($headid)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                CustomBanner::where('id', '=', $headid)->update($input);
                return redirect('/admin/custom-development')->with('success', 'Heading updated successfully!');
            }

        }
        if ($request->has('card4-submit')) {

            $id = $request->txtpkey;
            $request->validate([
                'headingcard4' => 'required',
                //'descriptioncard3' => 'required',
            ], [
                'headingcard4' => 'Heading is Required',
                //'descriptioncard3' => 'Description is Required',
            ]);
            if ($request->has('card4_image_path')) {
                $request->validate([
                    'card4_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'card4_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'card4_image_path.required' => 'Image is Required',
                ]);
                $input['image_path_1'] = $this->verifyAndUpload($request, 'card4_image_path', 'images/CustomBanner');
                $original_name = $request->file('card4_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->headingcard4;
            // $input['description'] = $request->description;   
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                CustomCardFour::where('id', '=', $id)->update($input);
                return redirect('/admin/custom-development')->with('success', 'Card  updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                CustomCardFour::create($input);
                return redirect('/admin/custom-development')->with('success', 'Card  added successfully!');
            }

        }

        if ($request->has('submit-small-banner')) {
            //  dd($request);
            $id = $request->id;
            $request->validate([
                'headingsmall' => 'required',
                //'descriptioncard3' => 'required',
            ], [
                'headingsmall' => 'Heading is Required',
                //'descriptioncard3' => 'Description is Required',
            ]);
            if ($request->has('smallbanner_image_path')) {
                $request->validate([
                    'smallbanner_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'smallbanner_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'smallbanner_image_path.required' => 'Image is Required',
                ]);
                $input['image_path_1'] = $this->verifyAndUpload($request, 'smallbanner_image_path', 'images/CustomBanner');
                $original_name = $request->file('smallbanner_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->headingsmall;
            // $input['description'] = $request->description;   
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                CustomSmallBanner::where('id', '=', $id)->update($input);
                return redirect('/admin/custom-development')->with('success', 'Banner  updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                CustomSmallBanner::create($input);
                return redirect('/admin/custom-development')->with('success', 'Banner  added successfully!');
            }

        }
        

    }

    public function Cardtable(Request $request)
    {


        $card = StratergicCard::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($card)
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

                ->addColumn('image_path_1', function ($row) {
                    if (!empty($row->image_path_1)) {
                        // return '<img src="'$row->image_path_1'">';
                        return !empty($row->image_path_1) ? '<img src="' . $row->image_path_1 . '" class="table-img">' : '';

                    }
                })


                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/card/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="stratergic_card" data-flash="Blog Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';
                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="stratergic_card" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="stratergic_card" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['heading', 'discription', 'image_path_1', 'status', 'action'])
                ->make(true);
        }

    }

    public function Card3table(Request $request)
    {


        $card = StratergicCardthree::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($card)
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

                ->addColumn('image_path_1', function ($row) {
                    if (!empty($row->image_path_1)) {
                        // return '<img src="'$row->image_path_1'">';
                        return !empty($row->image_path_1) ? '<img src="' . $row->image_path_1 . '" class="table-img">' : '';

                    }
                })


                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/cardthree/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="stratergic_card3" data-flash="Blog Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';

                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="stratergic_card3" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-on tgle-on status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)" data-id="' . $row->id . '" data-table="stratergic_card3" data-flash="Status Changed Successfully!" class="change-status"><i class="fa fa-toggle-off tgle-off status_button" aria-hidden="true" title=""></i></a>';
                        return $statusBlockBtn;
                    }
                })
                
                ->rawColumns(['heading', 'discription', 'image_path_1', 'status', 'action'])
                ->make(true);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $cardid = crypt::decrypt($id);
        // dd($cardid);
        $card = StratergicCard::where('id', $cardid)->first();
        $banner = StratergicBanner::where('status', 'active')->first();
        $about = StratergicAboutus::where('status', 'active')->first();
        $smallbanner = StratergicsmallBanner::where('status', '!=', 'delete')->first();

        return view('admin/cms/services/strategic_consulting', compact('card','banner','about','smallbanner'));
    }


    public function EditCardThree(string $id)
    {
        //
        $cardid = crypt::decrypt($id);
        // dd($cardid);
        $cardthree = StratergicCardthree::where('id', $cardid)->first();
        $banner = StratergicBanner::where('status', 'active')->first();
        $about = StratergicAboutus::where('status', 'active')->first();
        $smallbanner = StratergicsmallBanner::where('status', '!=', 'delete')->first();
        

        return view('admin/cms/services/strategic_consulting', compact('cardthree','banner','about','smallbanner'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function CustomCardtable(Request $request)
    {

        $card = CustomCard::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($card)
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

                ->addColumn('image_path_1', function ($row) {
                    if (!empty($row->image_path_1)) {
                        // return '<img src="'$row->image_path_1'">';
                        return !empty($row->image_path_1) ? '<img src="' . $row->image_path_1 . '" class="table-img">' : '';

                    }
                })


                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/customcard/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="custom_card" data-flash="Blog Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';

                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="custom_card" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="custom_card" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['heading', 'discription', 'image_path_1', 'status', 'action'])
                ->make(true);
        }

    }
    public function editCustom(string $id)
    {
        //
        $cardid = crypt::decrypt($id);
        // dd($cardid);
        $card = customcard::where('id', $cardid)->first();
        $banner = CustomBanner::where('status', 'active')->first();
        $about = CustomAboutUs::where('status', 'active')->first();
        $smallbanner = CustomSmallBanner::where('status', '!=', 'delete')->first(); 

        return view('admin/cms/services/custom_development', compact('card','banner','about','smallbanner'));
    }

    public function CustomCardtable2(Request $request)
    {


        $card = CustomCardThree::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($card)
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

                ->addColumn('image_path_1', function ($row) {
                    if (!empty($row->image_path_1)) {
                        // return '<img src="'$row->image_path_1'">';
                        return !empty($row->image_path_1) ? '<img src="' . $row->image_path_1 . '" class="table-img">' : '';

                    }
                })


                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/customcard3/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="custom_card3" data-flash="Blog Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';

                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="custom_card3" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="custom_card3" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['heading', 'discription', 'image_path_1', 'status', 'action'])
                ->make(true);
        }


    }
    public function EditcustomCardThree(string $id)
    {
        //
        $cardid = crypt::decrypt($id);
        // dd($cardid);
        $cardthree = CustomCardThree::where('id', $cardid)->first();
        $banner = CustomBanner::where('status', 'active')->first();
        $about = CustomAboutUs::where('status', 'active')->first();
        $smallbanner = CustomSmallBanner::where('status', '!=', 'delete')->first();

        return view('admin/cms/services/custom_development', compact('cardthree','banner','about','smallbanner'));
    }
    public function CustomCardtable4(Request $request)
    {


        $card = CustomCardFour::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($card)
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

                ->addColumn('image_path_1', function ($row) {
                    if (!empty($row->image_path_1)) {
                        // return '<img src="'$row->image_path_1'">';
                        return !empty($row->image_path_1) ? '<img src="' . $row->image_path_1 . '" class="table-img">' : '';

                    }
                })


                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/customcard4/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="custom_card4" data-flash="Blog Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';

                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="custom_card4" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="custom_card4" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['heading', 'discription', 'image_path_1', 'status', 'action'])
                ->make(true);
        }


    }


    public function Digital_store(Request $request)
    {
        //
        // dd($request);

        $id = $request->txtpkey;
        if ($request->has('submit-banner')) {
            $request->validate([
                'heading' => 'required',
                'description' => 'required',
            ], [
                'heading' => 'Heading is Required',
                'description' => 'Description is Required',
            ]);
            if ($request->has('banner_image_path')) {
                $request->validate([
                    'banner_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'banner_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'banner_image_path.required' => 'Image is Required',
                ]);
                $input['banner_image_path'] = $this->verifyAndUpload($request, 'banner_image_path', 'images/DigiatlBanner');
                $original_name = $request->file('banner_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->heading;
            $input['description'] = $request->description;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                DigitalBanner::where('id', '=', $id)->update($input);
                return redirect('/admin/digital-marketing')->with('success', 'Banner  updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                DigitalBanner::create($input);
                return redirect('/admin/digital-marketing')->with('success', 'Banner  added successfully!');
            }
        }
        if ($request->has('about_section')) {

            $aboutid = $request->aboutid;
            $request->validate([
                'headingabout' => 'required',
                'descriptionabout' => 'required',
            ], [
                'headingabout' => 'Heading is Required',
                'descriptionabout' => 'Description is Required',
            ]);

            if ($request->has('about_image_path_1')) {
                $request->validate([
                    'about_image_path_1' => "mimes:jpg,png,jpeg|required",
                ], [
                    'about_image_path_1.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'about_image_path_1.required' => 'Image is Required',
                ]);
                $input['image_path_1'] = $this->verifyAndUpload($request, 'about_image_path_1', 'images/Digitalabout');
                $original_name = $request->file('about_image_path_1')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            if ($request->has('about_image_path_2')) {
                $request->validate([
                    'about_image_path_2' => "mimes:jpg,png,jpeg|required",
                ], [
                    'about_image_path_2.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'about_image_path_2.required' => 'Image is Required',
                ]);
                $input['image_path_2'] = $this->verifyAndUpload($request, 'about_image_path_2', 'images/Digitalabout');
                $original_name = $request->file('about_image_path_2')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            if ($request->has('about_image_path_3')) {
                $request->validate([
                    'about_image_path_3' => "mimes:jpg,png,jpeg|required",
                ], [
                    'about_image_path_3.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'about_image_path_3.required' => 'Image is Required',
                ]);
                $input['image_path_3'] = $this->verifyAndUpload($request, 'about_image_path_3', 'images/Digitalabout');
                $original_name = $request->file('about_image_path_3')->getClientOriginalName();
            }
            $input['heading'] = $request->headingabout;
            $input['discription'] = $request->descriptionabout;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($aboutid)) {

                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();

                DigitalAbout::where('id', '=', $aboutid)->update($input);
                return redirect('/admin/digital-marketing')->with('success', 'About section  updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();

                DigitalAbout::create($input);
                return redirect('/admin/digital-marketing')->with('success', 'About section  added successfully!');
            }

        }

        if ($request->has('head-submit')) {
            $headid = $request->id;

            $request->validate([
                'Headingsec2' => 'required',
                'Headingsub2' => 'required',
            ], [
                'Headingsec2' => 'Heading is Required',
                'Headingsub2' => 'Sub heading is Required',
            ]);
            $input['section2_heading'] = $request->Headingsec2;
            $input['section2_subheading'] = $request->Headingsub2;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($headid)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                DigitalBanner::where('id', '=', $headid)->update($input);
                return redirect('/admin/digital-marketing')->with('success', 'Heading updated successfully!');
            }

        }
        if ($request->has('cards-submit')) {

            $cardid = $request->cardid;
            $request->validate([
                'heading_card' => 'required',
                'description_card' => 'required',
            ], [
                'heading_card' => 'Heading is Required',
                'description_card' => 'Description is Required',
            ]);
            if ($request->has('card_image_path')) {
                $request->validate([
                    'card_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'card_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'card_image_path.required' => 'Image is Required',
                ]);
                $input['image_path_1'] = $this->verifyAndUpload($request, 'card_image_path', 'images/DigitalCards');
                $original_name = $request->file('card_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->heading_card;
            $input['discription'] = $request->description_card;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($cardid)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                DigitalCard::where('id', '=', $cardid)->update($input);
                return redirect('/admin/digital-marketing')->with('success', 'Card updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                DigitalCard::create($input);
                return redirect('/admin/digital-marketing')->with('success', 'Card added successfully!');
            }



        }
        if ($request->has('head-submit3')) {
            $headid = $request->id;

            $request->validate([
                'heading3' => 'required',
                'subheading3' => 'required',
            ], [
                'heading3' => 'Heading is Required',
                'subheading3' => 'Sub heading is Required',
            ]);
            $input['section3_heading'] = $request->heading3;
            $input['section3_subheading'] = $request->subheading3;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($headid)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                DigitalBanner::where('id', '=', $headid)->update($input);
                return redirect('/admin/digital-marketing')->with('success', 'Heading updated successfully!');
            }

        }
        if ($request->has('card3-submit')) {
            //  dd($request);
            $id = $request->id;
            $request->validate([
                'headingcard3' => 'required',
                //'descriptioncard3' => 'required',
            ], [
                'headingcard3' => 'Heading is Required',
                //'descriptioncard3' => 'Description is Required',
            ]);
            if ($request->has('card3_image_path')) {
                $request->validate([
                    'card3_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'card3_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'card3_image_path.required' => 'Image is Required',
                ]);
                $input['image_path_1'] = $this->verifyAndUpload($request, 'card3_image_path', 'images/DigitalBanner');
                $original_name = $request->file('card3_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->headingcard3;
            // $input['description'] = $request->description;   
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                DigitalCardThree::where('id', '=', $id)->update($input);
                return redirect('/admin/digital-marketing')->with('success', 'Card  updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                DigitalCardThree::create($input);
                return redirect('/admin/digital-marketing')->with('success', 'Card  added successfully!');
            }

        }
        if ($request->has('submit-small-banner')) {

            $id = $request->id;
            $request->validate([
                'headingsmall' => 'required',
                //'descriptioncard3' => 'required',
            ], [
                'headingsmall' => 'Heading is Required',
                //'descriptioncard3' => 'Description is Required',
            ]);
            if ($request->has('smallbanner_image_path')) {
                $request->validate([
                    'smallbanner_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'smallbanner_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'smallbanner_image_path.required' => 'Image is Required',
                ]);
                $input['image_path_1'] = $this->verifyAndUpload($request, 'smallbanner_image_path', 'images/DigitalBanner');
                $original_name = $request->file('smallbanner_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->headingsmall;
            // $input['description'] = $request->description;   
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                DigitalSmallBanner::where('id', '=', $id)->update($input);
                return redirect('/admin/digital-marketing')->with('success', 'Banner  updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                DigitalSmallBanner::create($input);
                return redirect('/admin/digital-marketing')->with('success', 'Banner  added successfully!');
            }

        }
        

    }
    public function DigitalCardtable(Request $request)
    {


        $card = DigitalCard::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($card)
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

                ->addColumn('image_path_1', function ($row) {
                    if (!empty($row->image_path_1)) {
                        // return '<img src="'$row->image_path_1'">';
                        return !empty($row->image_path_1) ? '<img src="' . $row->image_path_1 . '" class="table-img">' : '';

                    }
                })


                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/digitalcard/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="digital_card" data-flash="Blog Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';

                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="digital_card" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="digital_card" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['heading', 'discription', 'image_path_1', 'status', 'action'])
                ->make(true);
        }


    }
    public function EditdigitalCard(string $id)
    {
        //
        $cardid = crypt::decrypt($id);
        // dd($cardid);
        $card = DigitalCard::where('id', $cardid)->first();
        $banner = DigitalBanner::first();
        $about = DigitalAbout::where('status', 'active')->first();
        $smallbanner = DigitalSmallBanner::where('status', '!=', 'delete')->first();  


        return view('admin/cms/services/digital_marketing', compact('card','banner', 'about', 'smallbanner'));
    }

    public function DigitalCardtable6(Request $request)
    {


        $card = DigitalCardThree::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($card)
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

                ->addColumn('image_path_1', function ($row) {
                    if (!empty($row->image_path_1)) {
                        // return '<img src="'$row->image_path_1'">';
                        return !empty($row->image_path_1) ? '<img src="' . $row->image_path_1 . '" class="table-img">' : '';

                    }
                })


                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/digitalcardthree/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="digital_card3" data-flash="Blog Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';

                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="digital_card3" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="digital_card3" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['heading', 'discription', 'image_path_1', 'status', 'action'])
                ->make(true);
        }


    }

    public function EditdigitalCardThree(string $id)
    {
        //
        $cardid = crypt::decrypt($id);
        // dd($cardid);
        $cardthree = DigitalCardThree::where('id', $cardid)->first();
        $banner = DigitalBanner::first();
        $about = DigitalAbout::where('status', 'active')->first();
        $smallbanner = DigitalSmallBanner::where('status', '!=', 'delete')->first();  


        return view('admin/cms/services/digital_marketing', compact('cardthree','banner', 'about', 'smallbanner'));
    }
    public function EditcustomCardFour(string $id)
    {
        //
        $cardid = crypt::decrypt($id);
        // dd($cardid);
        $cardfour = CustomCardFour::where('id', $cardid)->first();
        $banner = CustomBanner::where('status', 'active')->first();
        $about = CustomAboutUs::where('status', 'active')->first();
        $smallbanner = CustomSmallBanner::where('status', '!=', 'delete')->first();


        return view('admin/cms/services/custom_development', compact('cardfour','banner','about','smallbanner'));
    }

    public function AppDevelopement_store(request $request)
    {


        $id = $request->txtpkey;
        if ($request->has('submit-banner')) {
            $request->validate([
                'heading' => 'required',
                'description' => 'required',
            ], [
                'heading' => 'Heading is Required',
                'description' => 'Description is Required',
            ]);
            if ($request->has('banner_image_path')) {
                $request->validate([
                    'banner_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'banner_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'banner_image_path.required' => 'Image is Required',
                ]);
                $input['banner_image_path'] = $this->verifyAndUpload($request, 'banner_image_path', 'images/AppBanner');
                $original_name = $request->file('banner_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->heading;
            $input['description'] = $request->description;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                AppBanner::where('id', '=', $id)->update($input);
                return redirect('/admin/mobile-app-development')->with('success', 'Banner  updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                AppBanner::create($input);
                return redirect('/admin/mobile-app-development')->with('success', 'Banner  added successfully!');
            }
        }


        if ($request->has('head-submit')) {
            $headid = $request->id;

            $request->validate([
                'Headingsec2' => 'required',
                'Headingsub2' => 'required',
            ], [
                'Headingsec2' => 'Heading is Required',
                'Headingsub2' => 'Sub heading is Required',
            ]);
            $input['section1_heading'] = $request->Headingsec2;
            $input['section1_subheading'] = $request->Headingsub2;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($headid)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                AppBanner::where('id', '=', $headid)->update($input);
                return redirect('/admin/mobile-app-development')->with('success', 'Heading updated successfully!');
            }
        }
        if ($request->has('cards-submit')) {

            $cardid = $request->cardid;
            $request->validate([
                'heading_card' => 'required',
                'description_card' => 'required',
            ], [
                'heading_card' => 'Heading is Required',
                'description_card' => 'Description is Required',
            ]);
            if ($request->has('card_image_path')) {
                $request->validate([
                    'card_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'card_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'card_image_path.required' => 'Image is Required',
                ]);
                $input['image_path_1'] = $this->verifyAndUpload($request, 'card_image_path', 'images/AppCards');
                $original_name = $request->file('card_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->heading_card;
            $input['discription'] = $request->description_card;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($cardid)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Appcard::where('id', '=', $cardid)->update($input);
                return redirect('/admin/mobile-app-development')->with('success', 'Card  updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Appcard::create($input);
                return redirect('/admin/mobile-app-development')->with('success', 'Card  added successfully!');
            }



        }
        if ($request->has('head-submit2')) {
            $headid = $request->id;

            $request->validate([
                'Headingsec2' => 'required',
                'Headingsub2' => 'required',
                'descriptionsub2' => 'required',
            ], [
                'heading2' => 'Heading is Required',
                'subheading2' => 'Sub heading is Required',
                'descriptionsub2' => 'Discription heading is Required',
            ]);
            $input['section2_heading'] = $request->Headingsec2;
            $input['section2_subheading'] = $request->Headingsub2;
            $input['section2heading_discription'] = $request->descriptionsub2;
            if ($request->has('sec2_image_path')) {
                $request->validate([
                    'sec2_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'sec2_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'sec2_image_path.required' => 'Image is Required',
                ]);
                $input['section2heading_image'] = $this->verifyAndUpload($request, 'sec2_image_path', 'images/AppCards');
                $original_name = $request->file('sec2_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }

            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($headid)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                AppBanner::where('id', '=', $headid)->update($input);
                return redirect('/admin/mobile-app-development')->with('success', 'Heading updated successfully!');
            }

        }
        if ($request->has('card2-submit')) {
            //  dd($request);
            $id = $request->cardid;
            $request->validate([
                'heading_card' => 'required',
                'description_card' => 'required',
            ], [
                'heading_card' => 'Heading is Required',
                'description_card' => 'Description is Required',
            ]);
            if ($request->has('card2_image_path')) {
                $request->validate([
                    'card2_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'card2_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'card2_image_path.required' => 'Image is Required',
                ]);
                $input['image_path_1'] = $this->verifyAndUpload($request, 'card2_image_path', 'images/AppCards');
                $original_name = $request->file('card2_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->heading_card;
            $input['discription'] = $request->description_card;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                Appcardtwo::where('id', '=', $id)->update($input);
                return redirect('/admin/mobile-app-development')->with('success', 'Card updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                Appcardtwo::create($input);
                return redirect('/admin/mobile-app-development')->with('success', 'Card added successfully!');
            }

        }


        if ($request->has('head-submit3')) {
            $headid = $request->id;

            $request->validate([
                'heading3' => 'required',
                'subheading3' => 'required',
            ], [
                'heading3' => 'Heading is Required',
                'subheading3' => 'Sub heading is Required',
            ]);
            $input['section3_heading'] = $request->heading3;
            $input['section3_subheading'] = $request->subheading3;
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($headid)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                AppBanner::where('id', '=', $headid)->update($input);
                return redirect('/admin/mobile-app-development')->with('success', 'Heading updated successfully!');
            }

        }
        if ($request->has('card3-submit')) {
            //  dd($request);
            $id = $request->id;
            $request->validate([
                'headingcard3' => 'required',
                //'descriptioncard3' => 'required',
            ], [
                'headingcard3' => 'Heading is Required',
                //'descriptioncard3' => 'Description is Required',
            ]);
            if ($request->has('card3_image_path')) {
                $request->validate([
                    'card3_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'card3_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'card3_image_path.required' => 'Image is Required',
                ]);
                $input['image_path_1'] = $this->verifyAndUpload($request, 'card3_image_path', 'images/AppCards');
                $original_name = $request->file('card3_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->headingcard3;
            // $input['description'] = $request->description;   
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                AppCardThree::where('id', '=', $id)->update($input);
                return redirect('/admin/mobile-app-development')->with('success', 'Card  updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                AppCardThree::create($input);
                return redirect('/admin/mobile-app-development')->with('success', 'Card  added successfully!');
            }

        }
        if ($request->has('submit-small-banner')) {

            $id = $request->id;
            $request->validate([
                'headingsmall' => 'required',
                //'descriptioncard3' => 'required',
            ], [
                'headingsmall' => 'Heading is Required',
                //'descriptioncard3' => 'Description is Required',
            ]);
            if ($request->has('smallbanner_image_path')) {
                $request->validate([
                    'smallbanner_image_path' => "mimes:jpg,png,jpeg|required",
                ], [
                    'smallbanner_image_path.mimes' => 'Image Must Be a JPG, PNG, or JPEG File',
                    'smallbanner_image_path.required' => 'Image is Required',
                ]);
                $input['image_path_1'] = $this->verifyAndUpload($request, 'smallbanner_image_path', 'images/AppBanner');
                $original_name = $request->file('smallbanner_image_path')->getClientOriginalName();
                // $input['portfolio_banner_image_name'] = $original_name;
            }
            $input['heading'] = $request->headingsmall;
            // $input['description'] = $request->description;   
            // $input['banner_image_path'] = $request->portfolio_description;

            if (!empty($id)) {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                AppSmallBanner::where('id', '=', $id)->update($input);
                return redirect('/admin/mobile-app-development')->with('success', 'Banner updated successfully!');
            } else {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                AppSmallBanner::create($input);
                return redirect('/admin/mobile-app-development')->with('success', 'Banner added successfully!');
            }

        }
       
    }

    public function DataTablesec2(Request $request)
    {


        $card = Appcardtwo::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($card)
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

                ->addColumn('image_path_1', function ($row) {
                    if (!empty($row->image_path_1)) {
                        // return '<img src="'$row->image_path_1'">';
                        return !empty($row->image_path_1) ? '<img src="' . $row->image_path_1 . '" class="table-img">' : '';

                    }
                })


                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/appcardtwo/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="app_card2" data-flash="Blog Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';

                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="app_card2" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="app_card2" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['heading', 'discription', 'image_path_1', 'status', 'action'])
                ->make(true);
        }


    }
    public function EditAppCardTwo(string $id)
    {
        //
        $cardid = crypt::decrypt($id);
        // dd($cardid);
        $card2 = Appcardtwo::where('id', $cardid)->first();
        $banner = AppBanner::first();

        // $card=Appcard::where('status','!=','delete')->first();
        $smallbanner = AppSmallBanner::where('status', '!=', 'delete')->first();
        return view('admin/cms/services/mobile_app_development', compact('card2','banner','smallbanner'));
    }
    public function DataTablesec3(Request $request)
    {


        $card = AppcardThree::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($card)
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

                ->addColumn('image_path_1', function ($row) {
                    if (!empty($row->image_path_1)) {
                        // return '<img src="'$row->image_path_1'">';
                        return !empty($row->image_path_1) ? '<img src="' . $row->image_path_1 . '" class="table-img">' : '';

                    }
                })


                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/appcardthree/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="app_card3" data-flash="Blog Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';

                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="app_card3" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="app_card3" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['heading', 'discription', 'image_path_1', 'status', 'action'])
                ->make(true);
        }



    }
    public function EditAppCardThree(string $id)
    {
        //
        $cardid = crypt::decrypt($id);
        // dd($cardid);
        $cardthree = AppcardThree::where('id', $cardid)->first();
        $banner = AppBanner::first();

        // $card=Appcard::where('status','!=','delete')->first();
        $smallbanner = AppSmallBanner::where('status', '!=', 'delete')->first();
        return view('admin/cms/services/mobile_app_development', compact('cardthree','banner','smallbanner'));
    }

    public function DataTablesec1(Request $request)
    {


        $card = Appcard::where('status', '!=', 'delete')
            ->orderBy('id', 'desc')
            ->select('*')
            ->get();

        if ($request->ajax()) {
            return DataTables::of($card)
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

                ->addColumn('image_path_1', function ($row) {
                    if (!empty($row->image_path_1)) {
                        // return '<img src="'$row->image_path_1'">';
                        return !empty($row->image_path_1) ? '<img src="' . $row->image_path_1 . '" class="table-img">' : '';

                    }
                })


                ->addColumn('action', function ($row) {
                    $actionBtn = '<a href="' . url('admin/appcardone/' . Crypt::encrypt($row->id) . '/edit') . '"> <button type="button" data-id="' . $row->id . '" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                    <a href="javascript:void(0)" data-id="' . $row->id . '" data-table="app_card" data-flash="Blog Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>';

                    return $actionBtn;
                })
                ->addColumn('status', function ($row) {
                    if ($row->status == 'active') {
                        $statusActiveBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="app_card" data-flash="Status Changed Successfully!"  class="change-status"  ><i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i></a>';
                        return $statusActiveBtn;
                    } else {
                        $statusBlockBtn = '<a href="javascript:void(0)"  data-id="' . $row->id . '" data-table="app_card" data-flash="Status Changed Successfully!" class="change-status" ><i class="fa fa-toggle-off tgle-off  status_button" aria-hidden="true" title=""></></a>';
                        return $statusBlockBtn;
                    }
                })
                ->rawColumns(['heading', 'discription', 'image_path_1', 'status', 'action'])
                ->make(true);
        }


    }
    public function EditAppCardOne(string $id)
    {
        //
        $cardid = crypt::decrypt($id);
        // dd($cardid);
        $cardone = Appcard::where('id', $cardid)->first();
        $banner = AppBanner::first();

        // $card=Appcard::where('status','!=','delete')->first();
        $smallbanner = AppSmallBanner::where('status', '!=', 'delete')->first();

        return view('admin/cms/services/mobile_app_development', compact('cardone','banner','smallbanner'));
    }
}
