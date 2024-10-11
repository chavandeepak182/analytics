<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserConfigration;
use App\Models\GeneralSettings;
use Storage;
use Str;
use Session;
use App\Traits\MediaTrait;

class GeneralSettingsController extends Controller
{
    use MediaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $general_settings = GeneralSettings::where('status','=','active')
                                            ->select('id','contact_email','contact_mobile','contact_address','brochure_file_path','brochure_file_name')
                                            ->first();

        if(!empty($general_settings)){
            return view('admin.settings.general_settings_contact', compact('general_settings'));
        }else{
            return view('admin.settings.general_settings_contact');
        }
    }

    public function social_media_index()
    {
        $general_settings = GeneralSettings::where('status','=','active')
                                            ->select('*')
                                            ->first();

        if(!empty($general_settings)){
            return view('admin.settings.general_settings_social_media', compact('general_settings'));
        }else{
            return view('admin.settings.general_settings_social_media');
        }
    }
    
    public function UserConfig()
    {
        $settings = UserConfigration::select('*')
                                            ->first();
                                            // return $general_settings ;
                                            

        if(!empty($settings)){
            return view('admin.settings.configration', compact('settings'));
        }else{
            return view('admin.settings.configration');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function StoreConfigration(Request $request)
    {  //
    
    $id = $request->txtpkey;

         if(!empty($id)){
            $input['paid_captcha_amount'] = $request->paid_captcha_amount ;
            $input['standerd_captcha_amount'] = $request->standerd_captcha_amount ;
            $input['pemium_captcha_amount'] = $request->pemium_captcha_amount ;
            $input['demo_captcha_amount'] = $request->demo_captcha_amount;
            $input['minumum_withdraw_amount'] = $request->minumum_withdraw_amount;
            $input['timmer'] = $request->timmer;
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                UserConfigration::where('id','=',$id)->update($input);
                return redirect('admin/general-settings/userconfig')->with('success','Configration Settings updated successfully!');
            }else{
                 $input['paid_captcha_amount'] = $request->paid_captcha_amount;
                   $input['standerd_captcha_amount'] = $request->standerd_captcha_amount ;
                  $input['pemium_captcha_amount'] = $request->pemium_captcha_amount ;
                 $input['demo_captcha_amount'] = $request->demo_captcha_amount;
                 $input['minumum_withdraw_amount'] = $request->minumum_withdraw_amount;
                  $input['timmer'] = $request->timmer;
                $input['created_by'] = auth()->guard('admin')->user()->id;
                UserConfigration::create($input);
                return redirect('admin/general-settings/userconfig')->with('success','Configration Settings added successfully!');
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $id = $request->txtpkey;

        if($request->has('contact_settings')){
            
            $request->validate([
                'contact_email' => 'required|email',
                'contact_mobile' => 'required',
                'contact_address' => 'required|string',
            ]);
            // if($request->has('brochure_file_path')){
            //     $input['brochure_file_path'] = $this->verifyAndUpload($request, 'brochure_file_path', 'images/brochure');
            //     $original_name = $request->file('brochure_file_path')->getClientOriginalName();
            //     $input['brochure_file_name'] = $original_name;
            // }
   
                     if(!empty($id)){
            $input['contact_email'] = strtolower($request->contact_email);
            $input['contact_mobile'] = $request->contact_mobile;
            $input['contact_address'] = $request->contact_address;
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                GeneralSettings::where('id','=',$id)->update($input);
                return redirect('admin/general-settings/contact-settings')->with('success','Contact Settings updated successfully!');
            }else{
                 $input['contact_email'] = strtolower($request->contact_email);
                 $input['contact_mobile'] = $request->contact_mobile;
                 $input['contact_address'] = $request->contact_address;
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                GeneralSettings::create($input);
                return redirect('admin/general-settings/contact-settings')->with('success','Contact Settings added successfully!');
            }
        }

        if($request->has('social_media_settings')){
            $request->validate([
                'social_media_facebook_url' => 'required|string',
                'social_media_instagram_url' => 'required|string',
                'social_media_linkedin_url' => 'required|string',
                'social_media_twitter_url' => 'required|string',
            ]);

            $input['social_media_facebook_url'] = $request->social_media_facebook_url;
            $input['social_media_instagram_url'] = $request->social_media_instagram_url;
            $input['social_media_linkedin_url'] = $request->social_media_linkedin_url;
            $input['social_media_twitter_url'] = $request->social_media_twitter_url;
            $input['whatsapp_chat_link'] = $request->chat_link;

            if(!empty($id)){
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                GeneralSettings::where('id','=',$id)->update($input);
                return redirect('admin/general-settings/social-media-settings')->with('success','Social Media Settings updated successfully!');
            }else{
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                GeneralSettings::create($input);
                return redirect('admin/general-settings/social-media-settings')->with('success','Social Media Settings added successfully!');
            }
            
        }
        
        
          if($request->has('analytics_code'))
        {
            // return $request;
            // die;
            $input['analytics_code'] = $request->analytics_code_value;
    
            if(!empty($id)){
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                GeneralSettings::where('id','=',$id)->update($input);
                return redirect('admin/general-settings/analytics')->with('success','Analytics Code updated successfully!');
            }else{
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                GeneralSettings::create($input);
                return redirect('admin/general-settings/analytics')->with('success','Analytics Code added successfully!');
            }
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
