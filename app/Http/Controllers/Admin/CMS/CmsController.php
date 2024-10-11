<?php

namespace App\Http\Controllers\Admin\Cms;

use App\Http\Controllers\Controller;
use App\Traits\MediaTrait;
use Illuminate\Http\Request;
use App\Models\CMS;
use Str;
use Session;

class CmsController extends Controller
{
    use MediaTrait;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.cms.cms');
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
        //
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
    public function edit(Request $request)
    {
        //     echo "<pre>";
        //    print_r($request->pageName);
        //    die;
        if ($request->pageName != '') {
            $result = CMS::where('id', $request->pageName)
                ->select('banner_heading', 'banner_description', 'banner_image_path', 'banner_image_name','description', 'meta_title', 'meta_keywords', 'meta_description')
                ->first();

            $data = [
                'banner_heading' => $result->banner_heading,
                'banner_description' => $result->banner_description,
                'banner_image_path' => $result->banner_image_path,
                'banner_image_name' => $result->banner_image_name,
                'description' => $result->description,
                'meta_title' => $result->meta_title,
                'meta_keywords' => $result->meta_keywords,
                'meta_description' => $result->meta_description,
            ];
            return $data;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die;
        // echo $request->id;
        // die;
        $validator = $request->validate([
            'id' => 'required',
        ]);

        if ($validator) {

            $input = [];
            if ($request->description != '') {
                $input['description'] =  $request->description;
            }
            if ($request->has('banner_image_path')) {
                $input['banner_image_path'] = $this->verifyAndUpload($request, 'banner_image_path', 'images/cms_images');
                $original_name = $request->file('banner_image_path')->getClientOriginalName();
                $input['banner_image_name'] = $original_name;
            }
            $input['banner_heading'] = $request->banner_heading;
            $input['banner_description'] = $request->banner_description;
            // $input['banner_image_path'] = $request->banner_image_path;
            // $input['banner_image_name'] = $request->banner_image_name;
            $input['meta_title'] = $request->meta_title;
            $input['meta_keywords'] = $request->meta_keywords;
            $input['meta_description'] = $request->meta_description;
            $input['modified_ip_address'] = $request->ip();
            $input['modified_by'] = auth()->guard('admin')->user()->id;

            $result = CMS::where('id', $request->id)->update($input);

            if ($result) {
                return redirect('admin/cms')->with('success', 'Page updated successfully!');
            } else {
                //     echo "failed";
                // die;
                return redirect('admin/cms')->with('error', 'Page not updated.');
            }
        }
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
