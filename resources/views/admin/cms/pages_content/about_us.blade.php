@extends('admin.layout.layout')

@section('meta_title', 'Custom Title')
@section('meta_description', 'Custom Description')
@section('meta_keywords', 'Custom, Keywords')

@section("content")

<style>
    .content-wrapper {
        min-height: 0 !important;
    }

    table tbody tr td:nth-child(1),
    table tbody tr td:nth-child(2),
    table tbody tr td:nth-child(5),
    table tbody tr td:nth-child(6) {
        text-align: center;
    }
</style>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row no-margin">
            <div class="col-md-12 no-pad">
                <section class="content-header">
                    <h1>About Us
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
                                            <h1>Section 1</h1>
                                        </section>
                                    </div>
                                    <form action="{{route('about.store')}}" class="form-validate is-alter"  method="POST" id="system_users_form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{!empty($about->id)?$about->id:''}}">
                                        <input type="hidden" name="section_id" value="1">
                                        <div class="col-md-8">
                                            <div class="row">
                                                <div class="col-sm-12 no-pad-right form-group">
                                                    <label>Heading<span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="section_1_heading" name="section_1_heading"   value="{{old('section_1_heading',!empty($about->section_1_heading)?$about->section_1_heading:'')}}" >
                                                </div>
                                                <div class="col-sm-6 no-pad-right form-group">
                                                    <label>Description<span style="color: red;">*</span></label>
                                                    <textarea class="form-control summernote" name="section_1_description_1" id="section_1_description_1" value={{old('section_1_description_1')}}>{{!empty($about->section_1_description_1)?$about->section_1_description_1:''}}</textarea>
                                                </div>
                                                <div class="col-sm-6 no-pad-right form-group">
                                                    <label>Description<span style="color: red;">*</span></label>
                                                    <textarea class="form-control summernote" name="section_1_description_2" id="section_1_description_2" value={{old('section_1_description_2')}}>{{!empty($about->section_1_description_2)?$about->section_1_description_2:''}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group">
                                            <label>Upload Image <small class="text-danger">( 570 * 380 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                            <input type="file" class="form-control preview" id="section_1_image_path" name="section_1_image_path" value="{{old('section_1_image_path')}}" accept=".jpg,.jpeg,.bmp,.png,">

                                            <input type="hidden" name="old_profile_image" id="old_profile_image" value="{{!empty($about->section_1_image_path) ? $about->section_1_image_path: '';}}" class="form-control preview">
                                            <div class="clearfix"></div>
                                            <img src="{{!empty($about->section_1_image_path) ?url('/').Storage::url($about->section_1_image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image" alt="{{!empty($about->section_1_image_name) ? $about->section_1_image_path : 'Default Image';}}">
                                            <div class="clearfix"></div>
                                        </div>

                                        <div class="col-md-6 no-pad">
                                            <div class="col-md-12">
                                                <h6 class="become_formHead">Our Mission</h6>
                                            </div>
                                            <div class="col-sm-12 no-pad-right form-group">
                                                <label>Heading<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" id="our_mission" name="our_mission" value="{{old('our_mission',!empty($about->our_mission)?$about->our_mission:'')}}" >
                                            </div>
                                            <div class="col-sm-12 no-pad-right form-group">
                                                <label>Description<span style="color: red;">*</span></label>
                                                <textarea class="form-control summernote" name="our_mission_description" id="our_mission_description" value={{old('our_mission_description')}}>{{!empty($about->our_mission_description)?$about->our_mission_description:''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 no-pad-left">
                                            <div class="col-md-12">
                                                <h6 class="become_formHead">Our Value</h6>
                                            </div>
                                            <div class="col-sm-12 no-pad-right form-group">
                                                <label>Heading<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" id="our_values" name="our_values" value="{{old('our_values',!empty($about->our_values)?$about->our_values:'')}}">
                                            </div>
                                            <div class="col-sm-12 no-pad-right form-group">
                                                <label>Description<span style="color: red;">*</span></label>
                                                <textarea class="form-control summernote" name="our_values_description" id="our_values_description"  value={{old('our_values_description')}} >{{!empty($about->our_values_description)?$about->our_values_description:''}}</textarea>
                                            </div>
                                        </div>

                                        <div class="col-md-6 no-pad">
                                            <div class="col-md-12">
                                                <h6 class="become_formHead">Core Values</h6>
                                            </div>
                                            <div class="col-sm-12 no-pad-right form-group">
                                                <label>Heading<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" id="core_values" name="core_values" value="{{old('core_values',!empty($about->core_values)?$about->core_values:'')}}" >
                                            </div>
                                            <div class="col-sm-12 no-pad-right form-group">
                                                <label>Description<span style="color: red;">*</span></label>
                                                <textarea class="form-control summernote" name="core_values_description" id="core_values_description" value={{old('core_values_description')}}>{{!empty($about->core_values_description)?$about->core_values_description:''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 no-pad-left">
                                            <div class="col-md-12">
                                                <h6 class="become_formHead">Core Offerings</h6>
                                            </div>
                                            <div class="col-sm-12 no-pad-right form-group">
                                                <label>Heading<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" id="core_offerings" name="core_offerings" value="{{old('core_offerings',!empty($about->core_offerings)?$about->core_offerings:'')}}">
                                            </div>
                                            <div class="col-sm-12 no-pad-right form-group">
                                                <label>Description<span style="color: red;">*</span></label>
                                                <textarea class="form-control summernote" name="core_offerings_description" id="core_offerings_description"  value={{old('core_offerings_description')}} >{{!empty($about->core_offerings_description)?$about->core_offerings_description:''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-10">
                                            <button type="submit" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i>{{!empty($about) ? 'Update' : 'Add'}}</button>
                                            <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
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
                                            <h1>Section 2: Why Choose Us</h1>
                                        </section>
                                    </div>
                                    <form action="{{route('about.store')}}" class="form-validate is-alter" autocomplete="off" method="POST" id="system_users_form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{!empty($about->id)?$about->id:''}}">
                                        <input type="hidden" name="section_id" value="2">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-sm-6 form-group">
                                                    <label>Heading<span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="why_choose_us_heading" name="why_choose_us_heading" value="{{old('why_choose_us_heading',!empty($about->why_choose_us_heading)?$about->why_choose_us_heading:'')}}" >
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-md-6 form-group">
                                                    <label>Description 1<span style="color: red;">*</span></label>
                                                    <textarea class="form-control summernote" name="why_choose_us_description_1" id="why_choose_us_description_1" value={{old('why_choose_us_description_1')}} >{{!empty($about->why_choose_us_description_1)?$about->why_choose_us_description_1:''}}</textarea>
                                                </div>
                                                <div class="col-md-6 form-group">
                                                    <label>Description 2<span style="color: red;">*</span></label>
                                                    <textarea class="form-control summernote" name="why_choose_us_description_2" id="why_choose_us_description_2"  value={{old('why_choose_us_description_2')}}>{{!empty($about->why_choose_us_description_2)?$about->why_choose_us_description_2:''}}</textarea>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-30 mb-30">
                                            <button type="submit" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i>{{ !empty($about->id) ? 'Update' : "Add" }}</button>
                                            <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button>
                                        </div>
                                    </form>
                                    <div class="col-md-12">
                                        <div class="section-two-line"></div>
                                    </div>

                                    <form action="{{route('why.choose.us.store')}}" class="form-validate is-alter" method="POST" id="system_users_form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{!empty( $why_us_content->id)? $why_us_content->id:''}}">
    
                                        <div class="col-md-12">
                                            <section class="content-header">
                                                <h1>Section 2: Why Choose Us - Content</h1>
                                            </section>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-sm-12 form-group">
                                                    <label>Title<span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="content_title" name="content_title" value="{{old('content_title',!empty($why_us_content->content_title)?$why_us_content->content_title:'')}}" >
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Content Description<span style="color: red;">*</span></label>
                                                    <textarea class="form-control summernote" name="content_description" id="content_description" value="{{old("content_description")}}"  >{{!empty($why_us_content->content_description)?$why_us_content->content_description:''}}</textarea>
                                                </div>
                                                <div class="col-md-12 form-group">
                                                    <label>Upload Image <small class="text-danger">( 104 * 104 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                                    <input type="file" class="form-control preview1" id="content_image_path" name="content_image_path" accept=".jpg,.jpeg,.bmp,.png,">
                                                    <input type="hidden" name="old_profile_image" id="old_profile_image" value="{{!empty($why_us_content->content_image_path) ? $why_us_content->content_image_path: '';}}" class="form-control preview">
                                                    <div class="clearfix"></div>
                                                    <img src="{{!empty($why_us_content->content_image_path) ?url('/').Storage::url($why_us_content->content_image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image1" alt="{{!empty($why_us_content->content_image_name) ? $why_us_content->content_image_path: 'User Image';}}">
                                                    <div class="clearfix"></div>
                                                </div>
                                                <div class="col-md-12 mt-10 form-group">
                                                    <button type="submit" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i> {{ !empty($about->id) ? 'Update' : "Add" }}</button>
                                                    <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                                </div>

                                            </div>
                                        </div>
                                        <div class="col-sm-8 ">
                                            <div class="table-responsive">
                                                <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <table id="arm_data_table" class="table table-bordered dataTable no-footer">
                                                                <thead>
                                                                    <tr role="row">
                                                                        <th width="10%" class="text-center">Sr. No.</th>
                                                                        <th width="10%" class="">Image</th>
                                                                        <th width="28%" class="">Title</th>
                                                                        <th width="30%" class="">Description</th>
                                                                        <th width="10%" class="text-center">Status</th>
                                                                        <th width="12%" class="text-center">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                        </div> <!-- End box -->
                    </div>
                    <!-- Section 2 -->
                    <!-- Meta -->
                    <div class="col-md-12 no-pad">
                        <div class="box box-primary">
                            <div class="box-body" style="min-height: 260px;">
                               <form action="{{route('about.store')}}" class="form-validate is-alter" autocomplete="off" method="POST" id="system_users_form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{!empty($about->id)?$about->id:''}}">
                                    <input type="hidden" name="section_id" value="3">
                                    <div class="row">
                                        
                                        <div class="col-md-12 form-group">
                                            <label class="lablefnt">Meta Description</label>
                                            <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{old('meta_description',!empty($about->meta_description)?$about->meta_description:'')}}">
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label class="lablefnt">Meta Keyword</label>
                                            <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{old('meta_keyword',!empty($about->meta_title)?$about->meta_title:'')}}">
                                        </div>
                                        
                                        <div class="col-md-12 form-group">
                                            <label class="lablefnt">Meta Title</label>
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{old('meta_title',!empty($about->meta_title)?$about->meta_title:'')}}">
                                        </div>

                                        <div class="col-md-12 ">
                                            <button type="submit" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i> {{ !empty($about->id) ? 'Update' : "Add" }}</button>
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
<script src="{{ URL::asset('admin_panel/controller_js/cn_about_us.js')}}"></script>
<script type="text/javascript">
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


@endsection