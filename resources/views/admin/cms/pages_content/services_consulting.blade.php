@extends('admin.layout.layout')
@section("content")

<style>
    .content-wrapper {
        min-height: 0 !important;
    }
</style>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row no-margin">
            <div class="col-md-12 no-pad">
                <section class="content-header">
                    <h1>Service - Consulting
                        <div class="pull-right">
                            <a href="{{url('/admin/page-content')}}">
                                <button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</button>
                            </a>
                        </div>
                    </h1>
                </section>
                <section class="content" style="padding:5px 0px;">
                    <!-- Section 1 -->
                    <div class="col-md-12 no-pad">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="row ">
                                    <form action="{{route('consulting.service.store')}}" class="form-validate is-alter"  method="POST" id="system_users_form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{!empty($service->id)?$service->id:''}}">
                                        <input type="hidden" name="section_id" value="1">
                                        <div class="col-md-8 no-pad">
                                            <div class="col-sm-12 form-group">
                                                <label>Banner Heading<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" id="banner_heading" name="banner_heading" value="{{old('banner_heading',!empty($service->banner_heading)?$service->banner_heading:'')}}">
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Description<span style="color: red;">*</span></label>
                                                <textarea class="form-control summernote" name="description" id="description" value="{{old('description')}}">{{!empty($service->description)?$service->description:''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-4 form-group">
                                            <label>Upload Banner Image <small class="text-danger">( 1349 * 455 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                            <input type="file" class="form-control preview" id="banner_image_path" name="banner_image_path" accept=".jpg,.jpeg,.bmp,.png,">
                                            <input type="hidden" name="old_banner_image" id="old_banner_image" value="{{!empty($service->banner_image_path) ? $service->banner_image_path: '';}}" class="form-control preview">
                                            <div class="clearfix"></div>
                                            <img src="{{!empty($service->banner_image_path) ?url('/').Storage::url($service->banner_image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image" alt="{{!empty($service->banner_image_name) ? $service->banner_image_path: 'default image';}}">
                                            <div class="clearfix"></div>
                                        </div>
                                        <div class="col-md-12 ">
                                            <button type="submit" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i>{{!empty($service)?'Update':'Add'}}</button>
                                            <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- End box -->
                    </div>
                    <!-- Section 1 -->
                    <!-- Meta -->
                    <div class="col-md-12 no-pad">
                        <div class="box box-primary">
                            <div class="box-body" style="min-height: 260px;">
                               <form action="{{route('consulting.service.store')}}" class="form-validate is-alter"  method="POST" id="system_users_form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{!empty($service->id)?$service->id:''}}">
                                        <input type="hidden" name="section_id" value="2">
                                    <div class="row">
                                        
                                        <div class="col-md-12 form-group">
                                            <label class="lablefnt">Meta Description</label>
                                            <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{old('meta_description',!empty($service->meta_description)?$service->meta_description:'')}}">
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label class="lablefnt">Meta Keyword</label>
                                            <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{old('meta_keyword',!empty($service->meta_keyword)?$service->meta_keyword:'')}}">
                                        </div>

                                        <div class="col-md-12 form-group">
                                            <label class="lablefnt">Meta Title</label>
                                            <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{old('meta_title',!empty($service->meta_title)?$service->meta_title:'')}}">
                                        </div>

                                        <div class="col-md-12 ">
                                            <button type="submit" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i>{{!empty($service)?'Update':'Add'}}</button>
                                            <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div> <!-- End box -->
                    </div>
                </section>
            </div>


        </div>
        <!-- /.row -->
    </section>
</div>

@endsection
@section('script')

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