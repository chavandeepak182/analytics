@extends('admin.layout.layout')
@section("content")

<style>
    .content-wrapper {
        min-height: 0 !important;
    }
    table tbody tr td:nth-child(1),
    table tbody tr td:nth-child(2),
    table tbody tr td:nth-child(5),
    table tbody tr td:nth-child(6){
        text-align: center;
    }
</style>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row no-margin">
            <div class="col-md-12 no-pad">
                <section class="content-header">
                    <h1>Homepage
                        <div class="pull-right">
                            <a href="{{url('/admin/page-content')}}">
                                <button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</button>
                            </a>
                        </div>
                    </h1>
                </section>
                <section class="content" style="padding:5px 0px;">
                    <!-- Banner Section 1-->
                    <div class="col-md-12 no-pad">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <section class="content-header">
                                            <h1>Section 1: Banner</h1>
                                        </section>
                                    </div>
                                    <form action="{{route('home.store')}}" class="form-validate is-alter"  method="POST" id="system_users_form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{!empty($home->id)?$home->id:''}}">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-sm-12 no-pad-right form-group">
                                                    <label>Heading<span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="section_1_heading" name="section_1_heading" value="{{old('section_1_heading',!empty($home->section_1_heading)?$home->section_1_heading:'')}}" >
                                                    @if($errors->has('section_1_heading'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('section_1_heading')}}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-12 no-pad-right form-group">
                                                    <label>Sub-Heading<span style="color: red;">*</span></label>
                                                    <input type="text" id="section_1_sub_heading" name="section_1_sub_heading" class="form-control" value="{{old('section_1_sub_heading',!empty($home->section_1_sub_heading)?$home->section_1_sub_heading:'')}}">
                                                    @if($errors->has('section_1_sub_heading'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('section_1_sub_heading')}}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-12 no-pad-right form-group">
                                                    <label>Banner Content<span style="color: red;">*</span></label>
                                                    <textarea type="text" id="section_1_banner_content" name="section_1_banner_content" class="form-control" value="{{old('section_1_banner_content')}}">{{!empty($home->section_1_banner_content)?$home->section_1_banner_content:''}}</textarea>
                                                    @if($errors->has('section_1_banner_content'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('section_1_banner_content')}}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-12 no-pad-right form-group">
                                                    <label>Link<span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="section_1_link" name="section_1_link" value="{{old('section_1_link',!empty($home->section_1_link)?$home->section_1_link:'')}}">
                                                    @if($errors->has('section_1_link'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('section_1_link')}}</span>
                                                    @endif
                                                </div>
                                            </div>
    
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h6 class="become_formHead">Counter</h6>
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <label>Reports<span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="section_1_respondents" name="section_1_respondents" value="{{old('section_1_respondents',!empty($home->section_1_respondents)?$home->section_1_respondents:'')}}" >
                                                    @if($errors->has('section_1_respondents'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('section_1_respondents')}}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <label>Clients<span style="color: red;">*</span></label>
                                                    <input type="text" id="section_1_app_partners" name="section_1_app_partners" class="form-control" value="{{old('section_1_app_partners',!empty($home->section_1_app_partners)?$home->section_1_app_partners:'')}}">
                                                    @if($errors->has('section_1_app_partners'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('section_1_app_partners')}}</span>
                                                    @endif
                                                </div>
                                                <div class="col-sm-4 form-group">
                                                    <label>Targeted Globally<span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="section_1_targeted_globally" name="section_1_targeted_globally"  value="{{old('section_1_targeted_globally',!empty($home->section_1_targeted_globally)?$home->section_1_targeted_globally:'')}}">
                                                    @if($errors->has('section_1_targeted_globally'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('section_1_targeted_globally')}}</span>
                                                    @endif
                                                </div>
                                            </div>
    
                                        </div>


                                        <div class="col-sm-4 form-group no-pad-left">
                                            <div class="multiple-img-upload">
                                                <div class="form-group mt-5">
                                                    <label for="">Upload Banner Images</label>
                                                    <input type="file" class="form-control" name="section_1_banner_image_path[]" multiple id="upload-img2"/>
                                                </div>
                                            </div>
                                            <div class="img-thumbs" id="">

                                                @if (!empty($banner))
                                                @foreach($banner as $bannerData)
                                                <div class="wrapper-thumb" id="img_div_{{!empty($bannerData->id) ?($bannerData->id) : ''}}">
                                                    <img src="{{!empty($bannerData->image_path) ? url('/').Storage::url($bannerData->image_path) : '';}}" class="" alt="{{!empty($bannerData->image_name) ? $bannerData->image_name : 'Banner Image';}}">
                                                    <span class="remove-btn" style="color:red;" onclick="deleteBannerImage({{!empty($bannerData->id) ?($bannerData->id) : ''}})">x</span>
                                                </div>
                                                @endforeach

                                                @endif
                                            </div>
                                            <div class="upload-multiple-div img-thumbs-hidden2" id="img-preview2"></div>
                                        </div>

                                        <div class="col-md-12 mt-10">
                                            <button type="submit" name="section_1" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i>{{!empty($home->id) ? 'Update' : 'Add'}}</button>
                                            <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i>Clear</button></a>
                                        </div>
                                    </form>
                                </div>
                                
                                
                            </div>
                        </div> <!-- End box -->
                    </div>
                    <!-- Banner Section 1-->
                    <!-- Section 2 -->
                    <div class="col-md-12 no-pad">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <section class="content-header">
                                            <h1>Section 2: Market Research Dynamics</h1>
                                        </section>
                                    </div>
                                   <form action="{{route('home.store')}}" class="form-validate is-alter"  method="POST" id="system_users_form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{!empty($home->id)?$home->id:''}}">

                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-sm-12 form-group">
                                                    <label>Heading<span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="section_2_heading" name="section_2_heading" value="{{old('section_2_heading',!empty($home->section_2_heading)?$home->section_2_heading:'')}}">
                                                    @if($errors->has('section_2_heading'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('section_2_heading')}}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Description<span style="color: red;">*</span></label>
                                                    <textarea class="form-control summernote" name="section_2_description" id="section_2_description" value={{old('section_2_description')}}>{{!empty($home->section_2_description)?$home->section_2_description:''}}</textarea>
                                                    @if($errors->has('section_2_description'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('section_2_description')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 form-group no-pad-left ">
                                            <label>Upload Image <small class="text-danger">( 370 * 370 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                            <input type="file" class="form-control preview1" id="section_2_image_path" name="section_2_image_path">
                                            <input type="hidden" name="old_profile_image" id="old_profile_image" value="{{!empty($home->section_2_image_path)?$home->section_2_image_path: '';}}" class="form-control preview"  accept=".jpg,.jpeg,.bmp,.png,">
                                            <div class="clearfix"></div>
                                            <img src="{{!empty($home->section_2_image_path) ? url('/').Storage::url($home->section_2_image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image1" alt="{{!empty($user->user_profile_image_name) ? $user->user_profile_image_name : 'User Image';}}">
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" name="section_2" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i>{{!empty($home->id) ? 'Update' : 'Add'}}</button>
                                            <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- End box -->
                    </div>
                    <!-- Section 2 -->
                    <!-- Section 3 -->
                    <div class="col-md-12 no-pad">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <section class="content-header">
                                            <h1>Section 3: About Us</h1>
                                        </section>
                                    </div>

                                       <form action="{{route('home.store')}}" class="form-validate is-alter"  method="POST" id="system_users_form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{!empty($home->id)?$home->id:''}}">

                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-sm-12 form-group">
                                                    <label>Heading<span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="section_3_heading" name="section_3_heading" value="{{old('section_3_heading',!empty($home->section_3_heading)?$home->section_3_heading:'')}}" >
                                                    @if($errors->has('section_3_heading'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('section_3_heading')}}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Description<span style="color: red;">*</span></label>
                                                    <textarea class="form-control summernote" name="section_3_description" id="section_3_description" value="{{old('section_3_description')}}">{{!empty($home->section_3_description)?$home->section_3_description:''}}</textarea>
                                                    @if($errors->has('section_3_description'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('section_3_description')}}</span>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 form-group no-pad-left ">
                                            <label>Upload Image <small class="text-danger">( 570 * 380 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                            <input type="file" class="form-control preview4" id="section_3_image_path" name="section_3_image_path" accept=".jpg,.jpeg,.bmp,.png,">
                                            <input type="hidden" name="old_profile_image" id="old_profile_image" value="{{!empty($home->section_3_image_path) ?$home->section_3_image_path: '';}}" class="form-control preview">
                                            <div class="clearfix"></div>
                                            <img src="{{!empty($home->section_3_image_path) ? url('/').Storage::url($home->section_3_image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image4" alt="{{!empty($home->section_3_image_name) ? $home->section_3_image_path: 'User Image';}}">
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" name="section_3" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i>{{!empty($home->id) ? 'Update' : 'Add'}}</button>
                                            <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- End box -->
                    </div>
                    <!-- Section 3 -->
                    <!-- Section 4 -->

                    <!-- Section 4 -->
                    <!-- Section 5 -->
                    <div class="col-md-12 no-pad">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <section class="content-header">
                                            <h1>Section 4: Why Partner With Us?</h1>
                                        </section>
                                    </div>
                                  <form action="{{route('home.store')}}" class="form-validate is-alter"  method="POST" id="system_users_form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{!empty($home->id)?$home->id:''}}">
                                        
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-sm-12 form-group">
                                                    <label>Heading<span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="section_4_heading" name="section_4_heading" value="{{old('section_4_heading',!empty($home->section_4_heading)?$home->section_4_heading:'')}}" >
                                                    @if($errors->has('section_4_heading'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('section_4_heading')}}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-6 no-pad">
                                                    <div class="col-sm-12 form-group">
                                                        <label>Title 1<span style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" id="section_4_title_1" name="section_4_title_1" value="{{old('section_4_title_1',!empty($home->section_4_title_1)?$home->section_4_title_1:'')}}" >
                                                        @if($errors->has('section_4_title_1'))
                                                            <span class="text-danger"><b>*</b> {{$errors->first('section_4_title_1')}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>Description 1<span style="color: red;">*</span></label>
                                                        <textarea class="form-control summernote" name="section_4_description_1" id="section_4_description_1" value="{{ old('section_4_description_1') }}">{{!empty($home->section_4_description_1)?$home->section_4_description_1:''}}</textarea>
                                                        @if($errors->has('section_4_description_1'))
                                                            <span class="text-danger"><b>*</b> {{$errors->first('section_4_description_1')}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6 no-pad">
                                                    <div class="col-sm-12 form-group">
                                                        <label>Title 2<span style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" id="section_4_title_2" name="section_4_title_2" value="{{old('section_4_title_2',!empty($home->section_4_title_2)?$home->section_4_title_2:'')}}" >
                                                        @if($errors->has('section_4_title_2'))
                                                            <span class="text-danger"><b>*</b> {{$errors->first('section_4_title_2')}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>Description 2<span style="color: red;">*</span></label>
                                                        <textarea class="form-control summernote" name="section_4_description_2" id="section_4_description_2" value="{{ old('section_4_description_2') }}">{{!empty($home->section_4_description_2)?$home->section_4_description_2:''}}</textarea>
                                                        @if($errors->has('section_4_description_2'))
                                                            <span class="text-danger"><b>*</b> {{$errors->first('section_4_description_2')}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6 no-pad">
                                                    <div class="col-sm-12 form-group">
                                                        <label>Title 3<span style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" id="section_4_title_3" name="section_4_title_3" value="{{old('section_4_title_3',!empty($home->section_4_title_3)?$home->section_4_title_3:'')}}" >
                                                        @if($errors->has('section_4_title_3'))
                                                            <span class="text-danger"><b>*</b> {{$errors->first('section_4_title_3')}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>Description 3<span style="color: red;">*</span></label>
                                                        <textarea class="form-control summernote" name="section_4_description_3" id="section_4_description_3" value={{old('section_4_description_3')}}>{{!empty($home->section_4_description_3)?$home->section_4_description_3:''}}</textarea>
                                                        @if($errors->has('section_4_description_3'))
                                                            <span class="text-danger"><b>*</b> {{$errors->first('section_4_description_3')}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-6 no-pad">
                                                    <div class="col-sm-12 form-group">
                                                        <label>Title 4<span style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" id="section_4_title_4" name="section_4_title_4" value="{{old('section_4_title_4',!empty($home->section_4_title_4)?$home->section_4_title_4:'')}}" >
                                                        @if($errors->has('section_4_title_4'))
                                                            <span class="text-danger"><b>*</b> {{$errors->first('section_4_title_4')}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>Description 4<span style="color: red;">*</span></label>
                                                        <textarea class="form-control summernote" name="section_4_description_4" id="section_4_description_4" value={{old('section_4_description_4')}}>{{!empty($home->section_4_description_4)?$home->section_4_description_4:''}}</textarea>
                                                        @if($errors->has('section_4_description_4'))
                                                            <span class="text-danger"><b>*</b> {{$errors->first('section_4_description_4')}}</span>
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 form-group no-pad-left ">
                                            <div class="col-md-12">
                                                <label>Upload Image 1<small class="text-danger">( 370 * 370 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                                <input type="file" class="form-control preview5" id="section_4_image_1_path" name="section_4_image_1_path" accept=".jpg,.jpeg,.bmp,.png,">
                                                <input type="hidden" name="old_profile_image" id="old_profile_image" value="{{!empty($home->section_4_image_1_path) ? $home->section_4_image_1_path:'';}}" class="form-control preview5">
                                                <div class="clearfix"></div>
                                                <img src="{{!empty($home->section_4_image_1_path) ? url('/').Storage::url($home->section_4_image_1_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image5" alt="{{!empty($user->section_4_image_1_name) ? $user->section_4_image_1_name: 'User Image';}}">
                                                <div class="clearfix"></div>
                                            </div>
                                            <div class="col-md-12 mt-20">
                                                <label>Upload Image 2<small class="text-danger">( 370 * 370 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                                <input type="file" class="form-control preview6" id="section_4_image_2_path" name="section_4_image_2_path" accept=".jpg,.jpeg,.bmp,.png,">
                                                <input type="hidden" name="old_profile_image" id="old_profile_image" value="{{!empty($home->section_4_image_2_path) ?$home->section_4_image_2_path: '';}}" class="form-control preview6">
                                                <div class="clearfix"></div>
                                                <img src="{{!empty($home->section_4_image_2_path) ? url('/').Storage::url($home->section_4_image_2_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image6" alt="{{!empty($home->section_4_image_2_name) ? $home->section_4_image_2_name: 'User Image';}}">
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 ">
                                            <button type="submit" name="section_4" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i>{{!empty($home->id) ? 'Update' : 'Add'}}</button>
                                            <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- End box -->
                    </div>
                    <!-- Section 5 -->
                    <!-- Section 6 -->
                    <div class="col-md-12 no-pad">
                        <div class="box box-primary">
                            <div class="box-body" style="min-height: 250px;">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <section class="content-header">
                                            <h1>Section 5: Media ( Left Content )</h1>
                                        </section>
                                    </div>
                                     <form action="{{route('home.store')}}" class="form-validate is-alter"  method="POST" id="system_users_form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{!empty($home->id)?$home->id:''}}">
                                       
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-sm-12 form-group">
                                                    <label>Heading<span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="section_5_heading" name="section_5_heading" value="{{old('section_5_heading',!empty($home->section_5_heading)?$home->section_5_heading:'')}}" >
                                                    @if($errors->has('section_5_heading'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('section_5_heading')}}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-4 no-pad">
                                                    <div class="col-sm-12 form-group">
                                                        <label>Title 1<span style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" id="section_5_title_1" name="section_5_title_1" value="{{old('section_5_title_1',!empty($home->section_5_title_1)?$home->section_5_title_1:'')}}" >
                                                        @if($errors->has('section_5_title_1'))
                                                            <span class="text-danger"><b>*</b> {{$errors->first('section_5_title_1')}}</span>
                                                        @endif
                                                    </div>
                                                    <div class="col-md-12 form-group">
                                                        <label>Description 1<span style="color: red;">*</span></label>
                                                        <textarea class="form-control" name="section_5_description_1" id="section_5_description_1" value={{old('section_5_description_1')}}>{{!empty($home->section_5_description_1)?$home->section_5_description_1:''}}</textarea>
                                                        @if($errors->has('section_5_description_1'))
                                                            <span class="text-danger"><b>*</b> {{$errors->first('section_5_description_1')}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-pad">
                                                    <div class="col-sm-12 form-group no-pad-left">
                                                        <label>Title 2<span style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" id="section_5_title_2" name="section_5_title_2" value="{{old('section_5_title_2',!empty($home->section_5_title_2)?$home->section_5_title_2:'')}}" >
                                                        @if($errors->has('section_5_title_2'))
                                                            <span class="text-danger"><b>*</b> {{$errors->first('section_5_title_2')}}</span>
                                                        @endif

                                                    </div>
                                                    <div class="col-md-12 form-group no-pad-left">
                                                        <label>Description 2<span style="color: red;">*</span></label>
                                                      <textarea class="form-control" name="section_5_description_2" id="section_5_description_2" value={{old('section_5_description_2')}}>{{!empty($home->section_5_description_2)?$home->section_5_description_2:''}}</textarea>
                                                      @if($errors->has('section_5_description_2'))
                                                            <span class="text-danger"><b>*</b> {{$errors->first('section_5_description_2')}}</span>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="col-md-4 no-pad">
                                                    <div class="col-sm-12 form-group no-pad-left">
                                                        <label>Title 3<span style="color: red;">*</span></label>
                                                        <input type="text" class="form-control" id="section_5_title_3" name="section_5_title_3" value="{{old('section_5_title_3',!empty($home->section_5_title_3)?$home->section_5_title_3:'')}}" >
                                                        @if($errors->has('section_5_title_3'))
                                                            <span class="text-danger"><b>*</b> {{$errors->first('section_5_title_3')}}</span>
                                                        @endif

                                                    </div>
                                                    <div class="col-md-12 form-group no-pad-left">
                                                        <label>Description 3<span style="color: red;">*</span></label>
                                                        <textarea class="form-control" name="section_5_description_3" id="section_5_description_3" value={{old('section_5_description_3')}}>{{!empty($home->section_5_description_3)?$home->section_5_description_3:''}}</textarea>
                                                        @if($errors->has('section_5_description_3'))
                                                            <span class="text-danger"><b>*</b> {{$errors->first('section_5_description_3')}}</span>
                                                        @endif

                                                    </div>
                                                </div>
                                                <div class="col-md-12 ">
                                                    <button type="submit" name="section_5" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i>{{!empty($home->id) ? 'Update' : 'Add'}}</button>
                                                     <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- End box -->
                    </div>
                    <!-- Section 6 -->
                    <!-- Section 7 -->
                    <div class="col-md-12 no-pad">
                        <div class="box box-primary">
                            <div class="box-body" style="min-height: 250px;">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <section class="content-header">
                                            <h1>Section 6: Testimonials</h1>
                                        </section>
                                    </div>
                                    <form action="{{route('home.store')}}" class="form-validate is-alter"  method="POST" id="system_users_form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{!empty($home->id)?$home->id:''}}">
                                      
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="col-md-12 form-group">
                                                    <label>Heading<span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="section_6_heading" name="section_6_heading" value="{{old('section_6_heading',!empty($home->section_6_heading)?$home->section_6_heading:'')}}" >
                                                    @if($errors->has('section_6_heading'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('section_6_heading')}}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Description<span style="color: red;">*</span></label>
                                                    <textarea class="form-control" name="section_6_description" id="section_6_description" value="{{old('section_6_description')}}">{{!empty($home->section_6_description)?$home->section_6_description:''}}</textarea>
                                                    @if($errors->has('section_6_description'))
                                                        <span class="text-danger"><b>*</b> {{$errors->first('section_6_description')}}</span>
                                                    @endif
                                                </div>
                                                <div class="col-md-12 ">
                                                    <button type="submit" name="section_6" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i>{{!empty($home->id) ? 'Update' : 'Add'}}</button>
                                                    <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- End box -->
                    </div>
                    <!-- Section 7 -->
                    <!-- Section 8 -->
                    
                    <div class="col-md-12 no-pad">
                        <div class="box box-primary">
                            <div class="box-body" style="min-height: 180px;">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <section class="content-header">
                                            <h1>Section 7: Our Clients</h1>
                                        </section>
                                    </div>
                                   <form action="{{route('store.client.logo')}}" class="form-validate is-alter"  method="POST" id="system_users_form" enctype="multipart/form-data">
                                        @csrf
                                     
                                      
                                        <div class="col-sm-6 form-group">
                                            <div class="multiple-img-upload">
                                                <div class="form-group mt-5">
                                                    <label for="">Choose Client Images<small class="text-danger">( 170 * 200 , Only jpg,png &amp; jpeg format)</small></label>
                                                    <input type="file" class="form-control" name="image_path[]" multiple id="upload-img2"/>
                                                </div>
                                            </div>
                                                
                                        </div>
                                        <div class="col-md-12">
                                            <div class="img-thumbs" id="">

                                                @if (!empty($logo))
                                                @foreach($logo as $logoData)
                                                <div class="wrapper-thumb" id="img_div_{{!empty($logoData->id) ? ($logoData->id) : '';}}">
                                                    <img src="{{!empty($logoData->image_path) ? url('/').Storage::url($logoData->image_path) : '';}}" class="" alt="{{!empty($logoData->image_name) ? $logoData->image_name : 'Client Logo';}}">
                                                    <span class="remove-btn" style="color:red;" onclick="deleteClientLogo({{!empty($logoData->id) ? ($logoData->id) : ''}})">x</span>
                                                </div>
                                                @endforeach

                                                @endif
                                                </div>
                                                <div class="upload-multiple-div img-thumbs-hidden2" id="img-preview2"></div>
                                            </div>
                                        <div class="col-md-12 mt-10">
                                            <button type="submit" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i>{{!empty($home->id) ? 'Update' : 'Add'}}</button>
                                            <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- End box -->
                    </div>
                    <!-- Section 8 -->
                    <!-- Meta -->
                    <div class="col-md-12 no-pad">
                        <div class="box box-primary">
                            <div class="box-body" style="min-height: 260px;">
                                <form action="{{route('home.store')}}" class="form-validate is-alter"  method="POST" id="system_users_form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{!empty($home->id)?$home->id:''}}">
                                    
                                    <div class="row">
                                        
                                        <div class="col-md-12 form-group">
                                            <label class="lablefnt">Meta Description</label>
                                            <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{old('meta_description',!empty($home->meta_description)?$home->meta_description:'')}}">
                                            @if($errors->has('meta_description'))
                                                <span class="text-danger"><b>*</b> {{$errors->first('meta_description')}}</span>
                                            @endif
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label class="lablefnt">Meta Keyword</label>
                                            <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{old('meta_keyword',!empty($home->meta_keyword)?$home->meta_keyword:'')}}">
                                            @if($errors->has('meta_keyword'))
                                                <span class="text-danger"><b>*</b> {{$errors->first('meta_keyword')}}</span>
                                            @endif
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label class="lablefnt">Meta Title</label>
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{old('meta_title',!empty($home->meta_title)?$home->meta_title:'')}}">
                                            @if($errors->has('meta_title'))
                                                <span class="text-danger"><b>*</b> {{$errors->first('meta_title')}}</span>
                                            @endif                                         
                                        </div>

                                        <div class="col-md-12 ">
                                            <button type="submit" name="meta" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i>{{!empty($home->id) ? 'Update' : 'Add'}}</button>
                                            <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- End box -->
                    </div>
                    
                    <!-- Meta -->
                </section>
            </div>


        </div>
        <!-- /.row -->
    </section>
</div>

@endsection
@section('script')

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
    $(".s_meun").removeClass("active");
    $(".cms_menu_active").addClass("active");
    $(".page_content_active").addClass("active");
    $(".clear_btn").on("click", function() {
        location.reload();
    });
</script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
        }).on('summernote.keyup', function() {
            var text = $(".summernote").summernote("code").replace(/&nbsp;|<\/?[^>]+(>|$)/g, "").trim();
            if (text.length == 0) {
                $('#product_description-error').show();
            } else {
                $('#product_description-error').hide();
            }
        });
    });
</script>

<script>
    var imgUpload1 = document.getElementById('upload-img')
  , imgPreview1 = document.getElementById('img-preview')
  , imgUploadForm1 = document.getElementById('form-upload')
  , totalFiles1
  , previewTitle1
  , previewTitleText1
  , img1;

    imgUpload1.addEventListener('change', previewImgs1, true);

    function previewImgs1(event1) {
  totalFiles1 = imgUpload1.files.length;
        console.log(totalFiles1);
    if(!!totalFiles1) {
        imgPreview1.classList.remove('img-thumbs-hidden');
    }
  
  for(var i = 0; i < totalFiles1; i++) {
    wrapper1 = document.createElement('div');
    wrapper1.classList.add('wrapper-thumb');
    removeBtn1 = document.createElement("span");
    nodeRemove1= document.createTextNode('x');
    removeBtn1.classList.add('remove-btn');
    removeBtn1.appendChild(nodeRemove1);
    img1 = document.createElement('img');
    img1.src = URL.createObjectURL(event1.target.files[i]);
    img1.classList.add('img-preview-thumb');
    wrapper1.appendChild(img1);
    wrapper1.appendChild(removeBtn1);
    imgPreview1.appendChild(wrapper1);
   
    $('.remove-btn').click(function(){
      $(this).parent('.wrapper-thumb').remove();
    });    

  }
  
  
    }
</script>

<script>
    var imgUpload = document.getElementById('upload-img2')
  , imgPreview = document.getElementById('img-preview2')
  , imgUploadForm = document.getElementById('form-upload2')
  , totalFiles
  , previewTitle
  , previewTitleText
  , img;

    imgUpload.addEventListener('change', previewImgs, true);

    function previewImgs(event) {
  totalFiles = imgUpload.files.length;
        console.log(totalFiles);
  
     if(!!totalFiles) {
    imgPreview.classList.remove('img-thumbs-hidden2');
  }
  
  for(var i = 0; i < totalFiles; i++) {
    wrapper = document.createElement('div');
    wrapper.classList.add('wrapper-thumb');
    removeBtn = document.createElement("span");
    nodeRemove= document.createTextNode('x');
    removeBtn.classList.add('remove-btn');
    removeBtn.appendChild(nodeRemove);
    img = document.createElement('img');
    img.src = URL.createObjectURL(event.target.files[i]);
    img.classList.add('img-preview-thumb');
    wrapper.appendChild(img);
    wrapper.appendChild(removeBtn);
    imgPreview.appendChild(wrapper);
   
    $('.remove-btn').click(function(){
      $(this).parent('.wrapper-thumb').remove();
    });    

  }
  
  
    }
</script>
<script>
 
function deleteClientLogo(client_logo_id) {
    if (client_logo_id!= "") {
        if (confirm("Do you really want to delete this image ?")) {
            $.ajax({
                url: base_url + "/admin/delete-client-logo",
                
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                type: "POST",
                data: { client_logo_id: client_logo_id },
                success: function (response) {
                    if (response.status == "true") {
                        $('#img_div_' +client_logo_id).css('display', 'none');
                        success_toast("Success", response.message);
                    } else {
                        fail_toast("Error", response.message);
                    }
                },
                error: function (response) {
                    console.log("Error:", response);
                },
            });
        }
    }
}    
</script>    
<script>
 
function deleteBannerImage(banner_image_id) {
    if (banner_image_id!= "") {
        if (confirm("Do you really want to delete this image ?")) {
            $.ajax({
                url: base_url + "/admin/home-banner-image",
                
                headers: {
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                },
                type: "POST",
                data: { banner_image_id: banner_image_id },
                success: function (response) {
                    if (response.status == "true") {
                        $('#img_div_' +banner_image_id).css('display', 'none');
                        success_toast("Success", response.message);
                    } else {
                        fail_toast("Error", response.message);
                    }
                },
                error: function (response) {
                    console.log("Error:", response);
                },
            });
        }
    }
}    
</script>    

@endsection