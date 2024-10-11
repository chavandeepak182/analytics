@extends('admin.layout.layout')
@section('content')
  <style>
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 22px;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-left: 0px;
    }

  </style>
    <!-- Blogs View Starts -->

    <div class="content-wrapper add-blogs-section">
        <!-- Main content -->

        <!-- Page Banner -->

        <section class="content">
            <section class="content-header">

                <h1>Add Infographics
                    <div class="pull-right">
                        <a href="{{ url('admin/infographics') }}"><button type="button" class="btn btn-danger"><i
                                    class="fa fa-arrow-circle-left"></i> Back
                            </button></a>
                    </div>
                </h1>
            </section>

            <form action="{{route('infographics.store')}}" method="post" id="blog_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id"  value="{{!empty( $infographics->id) ? $infographics->id : '' }}"> 
                <div class="box box-primary">
                    <div class="box-body light-green-body" style="min-height: 210px;">
                        <div class="col-md-8 no-pad-left">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>Title<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control slug_url" name="title" id="title" value="{{!empty($infographics->title) ? $infographics->title : ''}}">
                                    @if($errors->has('title'))
                                        <span class="text-danger"><b>* {{$errors->first('title')}}</b></span>
                                    @endif
                                </div>
                                </div>
                                <div class="row">
                                <div class="col-md-12 form-group">
                                    <label>Report Name<span style="color: red;">*</span></label>
                                    <select class="form-control w-100" id="report_id" name="report_id">
                                        <option value="">Select Report</option>
                                        @foreach($all_report as $report)
                                            <option value="{{ !empty($report->id) ? $report->id : '' }}" {{ !empty($infographics->report_id) && $report->id == $infographics->report_id ? 'selected' : '' }}> {{ !empty($report->title) ? $report->title : '' }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4 no-padd-left">
                            <label>Upload Image <small class="text-danger">( 750 * 500 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                            <input type="file" class="form-control preview" id="image_path" name="image_path" accept=".jpg,.jpeg,.bmp,.png,">
                            <input type="hidden" name="old_profile_image" id="old_profile_image" value="{{!empty($infographics->image_path) ? $infographics->image_path : '';}}" class="form-control preview">
                            <div class="clearfix"></div>
                            <img src="{{!empty($infographics->image_path) ? url('/').Storage::url($infographics->image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image" alt="{{!empty($infographics->image_name) ? $infographics->image_name : 'Infographics Image';}}">
                            @if($errors->has('image_path'))
                                <span class="text-danger"><b>* {{$errors->first('image_path')}}</b></span>
                            @endif
                        </div>
                        <div class="col-md-12 no-pad-left form-group">
                            <div class="buttons">
                                <button type="submit" name="infographics" class="btn btn-success save_btn submit" data-id="submit"><i class="fa fa-check-circle"></i> {{ isset($infographics->id) && !empty($infographics->id) ? 'Update' : 'Submit' }}</button>
                                <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i>Clear</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- End box-body -->
             <!-- Meta -->
            <div class="box box-primary">
                <div class="box-body" style="min-height: 260px;">
                    <form action="{{route('infographics.store')}}" class="form-validate is-alter" autocomplete="off" method="POST" id="system_users_form" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id"  value="{{!empty($infographics->id)?$infographics->id:''}}">
                        <div class="row">
                            
                            <div class="col-md-12 form-group">
                                <label class="lablefnt">Meta Description</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{!empty($infographics->meta_description)?$infographics->meta_description:''}}">
                                @if($errors->has('meta_description'))
                                    <span class="text-danger"><b>* {{$errors->first('meta_description')}}</b></span>
                                @endif
                            </div>

                            <div class="col-md-12 form-group">
                                <label class="lablefnt">Meta Keyword</label>
                                <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{!empty($infographics->meta_keyword)?$infographics->meta_keyword:''}}">
                                @if($errors->has('meta_keyword'))
                                    <span class="text-danger"><b>* {{$errors->first('meta_keyword')}}</b></span>
                                @endif
                            </div>

                            <div class="col-md-12 form-group">
                                <label class="lablefnt">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{!empty($infographics->meta_title)?$infographics->meta_title:''}}">
                                @if($errors->has('meta_title'))
                                    <span class="text-danger"><b>* {{$errors->first('meta_title')}}</b></span>
                                @endif
                            </div>
                            <div class="col-md-12 ">
                                <button type="submit" name="meta" id="submit_btn" class="btn btn-success save_btn submit sub-btn "  {{ isset($infographics->id) && !empty($infographics->id) ? 'enabled' : 'disabled' }}><i class="fa fa-check-circle"></i> {{ isset($infographics->id) && !empty($infographics->id) ? 'Update' : 'Submit' }}</button>
                                <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div> <!-- End box -->
            <!-- Meta -->
        </section>
    </div>
    <!-- End box -->
@endsection
@section('script')
    <!-- <script src="{{ URL::asset('admin_panel/controller_js/cn_blogs.js') }}"></script> -->

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $("#report_id").select2({
            placeholder: "Select Report",
            allowClear: true
        });
    </script>

    <script type="text/javascript">
        $(".s_meun").removeClass("active");
        $(".media_menu_active").addClass("active");
        $(".media_infographics_active").addClass("active");

        $('.clear_btn').on('click', function() {
            location.reload();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 200,
            }).on('summernote.keyup', function() {
                var text = $(".summernote").summernote("code").replace(/&nbsp;|<\/?[^>]+(>|$)/g, "").trim();
                //alert(text);
                if (text.length == 0) {
                    $('.blog_description-error').show();
                } else {
                    $('.blog_description-error').hide();
                    // $("#btnForm").removeAttr("disabled");
                }
            });
        });
    </script>
@endsection
