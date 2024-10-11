@extends('admin.layout.layout')
@section("content")

<style>
     .content-wrapper {
        min-height: 0 !important;
    }
    table tbody tr td:nth-child(1),
    table tbody tr td:nth-child(2),
    table tbody tr td:nth-child(3),
    table tbody tr td:nth-child(6),
    table tbody tr td:nth-child(7),
    table tbody tr td:nth-child(9),
    table tbody tr td:nth-child(10){
        text-align: center;
    }
</style>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row no-margin">
            <div class="col-md-12 no-pad">
                <section class="content-header">
                    <h1>
                        Add Testimonial
                        <div class="pull-right">
                            <a href="{{url('/admin/testimonials')}}"><button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back
                                </button></a>
                        </div>
                    </h1>
                </section>

                <section class="content" style="padding:5px 0px;">
                    <form action="" method="post" id="testimonial_form" enctype="multipart/form-data" novalidate="novalidate">
                        <input type="hidden" name="_token" value="MHUm0CedY3kHVyWpkyC5h3EaFhClpKn6sdsYsfhx">                            <div class="box box-primary">
                            <div class="box-body light-green-body">

                                <div class="common_box">
                                    <div class="row">
                                        <!-- heading_col end -->
                                        <div class="col-md-8 form-group no-pad-right">

                                            <div class="col-md-6 form-group no-pad-left">
                                                <label>Name<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" name="name" id="name" value="">
                                            </div>

                                            <div class="col-md-6 form-group no-pad-left">
                                                <label>Designation<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" name="designation" id="designation" value="">
                                            </div>

                                            <div class="col-md-12 form-group no-pad-left">
                                                <label>Description<span style="color: red;">*</span></label>
                                                <textarea name="description" class="summernote form-control " id="description" data-gramm="false" wt-ignore-input="true"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-4 form-group no-pad-left">
                                            <div class="upload_img">
                                                <div class="upload_photo">
                                                    <label>User Image<span style="color: red;">* <small class="text-danger">(size:816*450)(.jpg, .jpeg,
                                                                .png)</small></span></label>
                                                    <input type="file" class="form-control preview" name="testimonial_image_path" id="testimonial_image_path" accept="image/*">
                                                </div>
                                                <div class="img-preview">
                                                    <div class="photo p-relative">
                                                        <img id="fileold" src="https://newcms.m-staging.in/Intellect_New_Website/admin_panel/commonarea/dist/img/default1.png" alt="testimonial Image" class="img-upload preview_image profile">
                                                        <input type="hidden" name="old_image" id="old_image" value="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <button type="submit" class="btn btn-success save_btn submit" data-id="submit"><i class="fa fa-check-circle"></i>
                                                    Submit
                                            </button>
                                            <a href=""> <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>
                    <!-- End box -->
                </section>
            </div>
        </div>
        <!-- end of row -->
    </section>
</div>

@endsection
@section('script')

<script type="text/javascript">
    $(".s_meun").removeClass("active");
    $(".cms_menu_active").addClass("active");
    $(".testimonials_active").addClass("active");
    $(".clear_btn").on("click", function() {
        location.reload();
    });
</script>

<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 400,
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

