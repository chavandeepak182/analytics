<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\VisualSettings;
use Storage;
use Str;
use Session;
use App\Traits\MediaTrait;

class VisualSettingsController extends Controller
{
    use MediaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $visual_settings = VisualSettings::where('status','=','active')
                                        ->select('id','logo_image_path',
                                        'logo_image_name',
                                       'logo_image_path2',
                                        'logo_image_name2',
                                        'mini_logo_image_path',
                                        'mini_logo_image_name',
                                        'logo_email_image_path',
                                        'logo_email_image_name',
                                        'favicon_image_path',
                                        'favicon_image_name')
                                        ->first();

        if(!empty($visual_settings)){
            return view('admin.settings.visual_settings', compact('visual_settings'));
        }else{
            return view('admin.settings.visual_settings');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);
        $id = $request->txtpkey;

            if($request->has('logo_image_path'))
            {
                $input['logo_image_path'] = $this->verifyAndUpload($request, 'logo_image_path', 'images/visual_settings_images');
                $original_name = $request->file('logo_image_path')->getClientOriginalName();
                $input['logo_image_name'] = $original_name;
            }
            if($request->has('logo_image_path2'))
            {
                $input['logo_image_path2'] = $this->verifyAndUpload($request, 'logo_image_path2', 'images/visual_settings_images');
                $original_name = $request->file('logo_image_path2')->getClientOriginalName();
                $input['logo_image_name2'] = $original_name;
            }

            if($request->has('mini_logo_image_path'))
            {
                $input['mini_logo_image_path'] = $this->verifyAndUpload($request, 'mini_logo_image_path', 'images/visual_settings_images');
                $original_name = $request->file('mini_logo_image_path')->getClientOriginalName();
                $input['mini_logo_image_name'] = $original_name;
            }

            if($request->has('logo_email_image_path'))
            {
                $input['logo_email_image_path'] = $this->verifyAndUpload($request, 'logo_email_image_path', 'images/visual_settings_images');
                $original_name = $request->file('logo_email_image_path')->getClientOriginalName();
                $input['logo_email_image_name'] = $original_name;
            }

            if($request->has('favicon_image_path'))
            {
                $input['favicon_image_path'] = $this->verifyAndUpload($request, 'favicon_image_path', 'images/visual_settings_images');
                $original_name = $request->file('favicon_image_path')->getClientOriginalName();
                $input['favicon_image_name'] = $original_name;
            }

            if(!empty($id))
            {
                $input['modified_by'] = auth()->guard('admin')->user()->id;
                $input['modified_ip_address'] = $request->ip();
                VisualSettings::where('id','=',$id)->update($input);
                return redirect('admin/visual-settings')->with('success','Visual Settings updated successfully!');
            }
            else
            {
                $input['created_by'] = auth()->guard('admin')->user()->id;
                $input['created_ip_address'] = $request->ip();
                VisualSettings::create($input);
                return redirect('admin/visual-settings')->with('success','Visual Settings added successfully!');
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
