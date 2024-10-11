@extends('admin.layout.layout')
@section('content')
  <style>

  </style>
    <!-- Blogs View Starts -->

    <div class="content-wrapper add-blogs-section">
        <!-- Main content -->

        <!-- Page Banner -->

        <section class="content">
            <div class="box box-primary" style="background: #fff;">
                <div class="box-body no-height">
                    <div class="row">
                        <form method="get">
                            
                            <div class="col-sm-3 form-group ">
                                <label>Select Type </label>
                                <select class="form-control w-100" id="" name="">
                                    <option value="">Select</option>
                                    <option value="">Privacy Policy</option>
                                    <option value="">Terms of Use</option>
                                    <option value="">GDPR</option>
                                </select>
                            </div>
                            
                        </form>
                    </div>
                </div>
            </div>

            <form action="" method="post" id="blog_form" enctype="multipart/form-data">
                <div class="box box-primary">
                    <div class="box-body light-green-body" style="min-height: 375px;">
                        <div class="row">
                            
                            <div class="col-md-12 form-group">
                                <label>Heading<span style="color: red;">*</span></label>
                                <input type="text" class="form-control slug_url" name="blog_title" id="blog_title" autocomplete="off">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Description<span style="color: red;">*</span></label>
                                <textarea name="blog_description" class="form-control summernote" id="blog_description" name="blog_description">{!! !empty($blog->blog_description) ? $blog->blog_description : '' !!}</textarea>
                                <label id="blog_description-error" class="error blog_description-error"
                                    for="blog_description"></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="buttons">
                                    <button type="submit" name="section_2" class="btn btn-success save_btn submit" data-id="submit"><i class="fa fa-check-circle"></i> Submit</button>
                                    <a href=""> <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                </div>
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
                                <a href="javascript:void(0);" class="btn btn-danger"><i class="fa fa-times-circle" aria-hidden="true"></i>Cancel</a>
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
        $(".cms_menu_active").addClass("active");
        $(".cms_active").addClass("active");

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
@endsection
