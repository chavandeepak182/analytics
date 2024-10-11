@extends('admin.layout.layout')
@section('content')
  <style>

  </style>
    <!--  Starts -->

    <div class="content-wrapper add-blogs-section">
        <!-- Main content -->

        <!-- Page Banner -->

        <section class="content">
            <section class="content-header">

                <h1>Add Press Release 
                    <div class="pull-right">
                        <a href="{{ url('admin/blogs') }}"><button type="button" class="btn btn-danger"><i
                                    class="fa fa-arrow-circle-left"></i> Back
                            </button></a>
                    </div>

                </h1>
            </section>

            <form action="" method="post" id="blog_form" enctype="multipart/form-data">
                <div class="box box-primary">
                    <div class="box-body light-green-body" style="min-height: 375px;">
                        <div class="col-md-4 no-pad">
                            <div class="row">
                                
                                <div class="col-md-12 form-group">
                                    <label>Title<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control slug_url" name="blog_title" id="blog_title" autocomplete="off">
                                </div>
                                <div id="datepicker" class="col-md-12 form-group">
                                    <label>Published On<span style="color: red;">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control blog_date pull-right datepick" id="blog_date" name="blog_date" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-md-12 form-group ">
                                    <label>Link URL<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control slug_url" name="blog_author" id="blog_author" autocomplete="off" >
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Upload Image <small class="text-danger">( 410 * 1170 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                    <input type="file" class="form-control" id="user_profile_image_path" name="user_profile_image_path" accept=".jpg,.jpeg,.bmp,.png,">
                                    <input type="hidden" name="old_profile_image" id="old_profile_image" value="{{!empty($user->user_profile_image_path) ? $user->user_profile_image_path : '';}}" class="form-control preview">
                                    <div class="clearfix"></div>
                                    <img src="{{!empty($user->user_profile_image_path) ? Storage::url($user->user_profile_image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image" alt="{{!empty($user->user_profile_image_name) ? $user->user_profile_image_name : 'User Image';}}">
                                </div>
                                <div class="clearfix"></div>
                                <div class="col-md-12 form-group">
                                    <div class="buttons">
                                        <button type="submit" name="section_2" class="btn btn-success save_btn submit" data-id="submit"><i class="fa fa-check-circle"></i> Submit</button>

                                        <a href=""> <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 no-pad">
                            <div class="col-md-12 form-group no-pad-right">
                                <label>Description<span style="color: red;">*</span></label>
                                <textarea name="blog_description" class="form-control summernote" id="blog_description" name="blog_description">{!! !empty($blog->blog_description) ? $blog->blog_description : '' !!}</textarea>
                                <label id="blog_description-error" class="error blog_description-error"
                                    for="blog_description"></label>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </form>
            <!-- End box-body -->
             <!-- Meta -->
            <div class="box box-primary">
                <div class="box-body" style="min-height: 260px;">
                    <form action="" class="form-validate is-alter" autocomplete="off" method="POST" id="system_users_form" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label class="lablefnt">Meta Title</label>
                                <input type="text" class="form-control" id="" name="" value="">
                            </div>

                            <div class="col-md-12 form-group">
                                <label class="lablefnt">Meta Keyword</label>
                                <input type="text" class="form-control" id="" name="" value="">
                            </div>

                            <div class="col-md-12 form-group">
                                <label class="lablefnt">Meta Description</label>
                                <input type="text" class="form-control" id="" name="" value="">
                            </div>
                            <div class="col-md-12 ">
                                <button type="submit" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i> Submit</button>
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
    <script type="text/javascript">
        $(".s_meun").removeClass("active");
        $(".media_menu_active").addClass("active");
        $(".media_blogs_active").addClass("active");

        $('.clear_btn').on('click', function() {
            location.reload();
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.summernote').summernote({
                height: 300,
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

    <script>
        //DATE_PICKER
        $(document).ready(function() {
            $('.datepick').datepicker({
                    format: 'yyyy-mm-dd',
                    autoclose: true,
                    todayHighlight: true,
                    changeMonth: true,
                    changeYear: true
                })

                .on("changeDate", function(selected) {
                    $('.date_error').html("");
                    $('.datepick ').removeClass("error");
                });
        });
    </script>
@endsection
