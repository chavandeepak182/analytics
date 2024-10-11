@extends('admin.layout.layout')
@section('content')
  <style>

  </style>
    <!-- Blogs View Starts -->

    <div class="content-wrapper add-blogs-section">
        <!-- Main content -->

        <!-- Page Banner -->

        <section class="content">
             <form action="{{route('privacy.policy.store')}}" method="post" id="blog_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" value="{{!empty($privacy->id)?$privacy->id:''}}">
                <div class="box box-primary">
                    <div class="box-body light-green-body" style="min-height: 375px;">
                        <div class="row">
                            
                            <div class="col-md-12 form-group">
                                 <h3><b>Privacy Policy Page Update</b></h3>
                                <label>Heading<span style="color: red;">*</span></label>
                                <input type="text" class="form-control slug_url" name="heading" id="heading" value="{{!empty($privacy->heading)?$privacy->heading:''}}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Description<span style="color: red;">*</span></label>
                                <textarea  class="form-control summernote" id="description" name="description">{{!empty($privacy->description)?$privacy->description : ''}}</textarea>
                                <label id="blog_description-error" class="error blog_description-error"
                                    for="blog_description"></label>
                            </div>
                            <div class="col-md-12 form-group">
                                <div class="buttons">
                                    <button type="submit" name="privacy" class="btn btn-success save_btn submit" data-id="submit"><i class="fa fa-check-circle"></i> {{!empty($privacy->id) ? 'Update' : 'Add'}}</button>
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
                     <form action="{{route('privacy.policy.store')}}" method="post" id="blog_form" enctype="multipart/form-data">
                         @csrf
                        <input type="hidden" name="id" value="{{!empty($privacy->id)?$privacy->id:''}}">
                        <div class="row">

                            <div class="col-md-12 form-group">
                                <label class="lablefnt">Meta Description</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{old('meta_description',!empty($privacy->meta_description)?$privacy->meta_description:'')}}">
                            </div>
                            
                            <div class="col-md-12 form-group">
                                <label class="lablefnt">Meta Keyword</label>
                                <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{old('meta_keyword',!empty($privacy->meta_keyword)?$privacy->meta_keyword:'')}}">
                            </div>

                            <div class="col-md-12 form-group">
                                <label class="lablefnt">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{old('meta_title',!empty($privacy->meta_title)?$privacy->meta_title:'')}}" >
                            </div>

                            <div class="col-md-12 ">
                                <button type="submit" name="meta" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i> {{!empty($privacy->id) ? 'Update' : 'Add'}}</button>
                                <a href=""> <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
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
        $(".privacy_policy_active").addClass("active");

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
