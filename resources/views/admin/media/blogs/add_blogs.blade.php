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
                <h1>Add Blog
                    <div class="pull-right">
                        <a href="{{ url('admin/blogs') }}"><button type="button" class="btn btn-danger"><i
                                class="fa fa-arrow-circle-left"></i> Back
                        </button></a>
                    </div>
                </h1>
            </section>

            <form action="{{route('blog.store')}}" method="post" id="blog_form" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="id" id="blog_id" value="{{!empty($blog->id)?$blog->id:''}}">
                <div class="box box-primary">
                    <div class="box-body light-green-body" style="min-height: 375px;">
                        <div class="col-md-4 no-pad-left">
                            <div class="row">
                                <div class="col-sm-12 form-group ">
                                    <label>Select Type</label>
                                    <select class="form-control w-100" id="page_type" name="page_type">
                                        <option value="">Select</option>
                                        <option value="blogs" @if(!empty($blog->type)){{($blog->type=='blogs')?'selected':''}}@endif>Blogs</option>
                                        <option value="press_release" @if(!empty($blog->type)){{($blog->type=='press_release')?'selected':''}}@endif>Press Release</option>
                                    </select>
                                    @if($errors->has('page_type'))
                                        <span class="text-danger"><b>* {{$errors->first('page_type')}}</b></span>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Title<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="title" id="title" value="{{old('title',!empty($blog->title)?$blog->title:'')}}">
                                    @if($errors->has('title'))
                                        <span class="text-danger"><b>* {{$errors->first('title')}}</b></span>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Slug Url<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="slug_url" id="slug_url" value="{{old('slug_url',!empty($blog->slug_url)?$blog->slug_url:'')}}">
                                    <span class="d-none text-danger" id="url_existence_message"></span>
                                    @if($errors->has('slug_url'))
                                        <span class="text-danger"><b>* {{$errors->first('slug_url')}}</b></span>
                                    @endif
                                </div>
                                <div class="col-md-6 form-group"  id="author_div">
                                    <label>Author<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="auther" id="auther" value="{{old('title',!empty($blog->auther)?$blog->auther:'')}}" >
                                    @if($errors->has('auther'))
                                        <span class="text-danger"><b>* {{$errors->first('auther')}}</b></span>
                                    @endif
                                </div>
                                <div id="datepicker" class="col-md-6 form-group no-padd-left">
                                    <label>Published On<span style="color: red;">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control blog_date pull-right datepick" id="date" name="date"  value="{{old('date',!empty($blog->published_on)?$blog->published_on:'')}}">
                                    </div>
                                    @if($errors->has('date'))
                                        <span class="text-danger"><b>* {{$errors->first('date')}}</b></span>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Upload Images <small class="text-danger">( 768 * 400 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                    <input type="file" class="form-control preview" id="image_path" name="image_path" accept=".jpg,.jpeg,.bmp,.png,">
                                    <input type="hidden" name="old_profile_image" id="old_profile_image" value="{{!empty($blog->image_path) ?$blog->image_path:'';}}" class="form-control preview">
                                    <div class="clearfix"></div>
                                    <img src="{{!empty($blog->image_path) ? url('/').Storage::url($blog->image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image" alt="{{!empty($blog->image_name) ? $blog->image_name :'User Image';}}">
                                    @if($errors->has('image_path'))
                                        <span class="text-danger"><b>* {{$errors->first('image_path')}}</b></span>
                                    @endif
                                </div>
                                <div class="clearfix"></div>
                            </div>
                        </div>
                        <div class="col-md-8 no-padd-left">
                            <div class="col-md-12 form-group" id="report_div">
                                <label>Select Report</label>
                                <select class="form-control w-100" id="report_id" name="report_id">
                                    <option value="">Select Report</option>
                                    @if(!empty($all_report))
                                    @foreach($all_report as $report)
                                        <option value="{{ !empty($report->id) ? $report->id : '' }}" {{ !empty($blog->report_id) && $report->id == $blog->report_id ? 'selected' : '' }}> {{ !empty($report->title) ? $report->title : '' }}</option>
                                    @endforeach
                                    @endif
                                </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>Description<span style="color: red;">*</span></label>
                                <textarea name="description" class="form-control summernote" id="description" name="description">{!! !empty($blog->description) ? $blog->description : '' !!}</textarea>
                                <label id="blog_description-error" class="error blog_description-error"
                                    for="blog_description"></label>
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="buttons">
                                <button type="submit" name="blog" id="update_btn" class="btn btn-success save_btn submit" data-id="submit"><i class="fa fa-check-circle"></i>{{!empty($blog)?'Update':'Add'}}</button>
                                <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            <!-- End box-body -->
                <!-- Meta -->
            <div class="box box-primary">
                <div class="box-body" style="min-height: 260px;">
                    <form action="{{route('blog.store')}}" method="post" id="blog_form" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{!empty($blog->id)?$blog->id:''}}">
                        <div class="row">
                            
                            <div class="col-md-12 form-group">
                                <label class="lablefnt">Meta Description</label>
                                <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{old('meta_description',!empty($blog->meta_description)?$blog->meta_description:'')}}">
                                @if($errors->has('meta_description'))
                                    <span class="text-danger"><b>* {{$errors->first('meta_description')}}</b></span>
                                @endif
                            </div>

                            <div class="col-md-12 form-group">
                                <label class="lablefnt">Meta Keyword</label>
                                <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{old('meta_keyword',!empty($blog->meta_keyword)?$blog->meta_keyword:'')}}">
                                @if($errors->has('meta_keyword'))
                                    <span class="text-danger"><b>* {{$errors->first('meta_keyword')}}</b></span>
                                @endif
                            </div>

                            <div class="col-md-12 form-group">
                                <label class="lablefnt">Meta Title</label>
                                <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{old('meta_title',!empty($blog->meta_title)?$blog->meta_title:'')}}">
                                @if($errors->has('meta_title'))
                                    <span class="text-danger"><b>* {{$errors->first('meta_title')}}</b></span>
                                @endif
                            </div>
                            
                            <div class="col-md-12 ">
                                <button type="submit" name="meta" id="submit_btn" class="btn btn-success save_btn submit sub-btn "  {{ isset($blog) && !empty($blog) ? 'enabled' : 'disabled' }}><i class="fa fa-check-circle"></i>{{!empty($blog)?'Update':'Add'}}</button>
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
                if (text.length == 0) {
                    $('.blog_description-error').show();
                } else {
                    $('.blog_description-error').hide();
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

    <script>
        $(document).ready(function(){
            if($("#page_type").val() == "press_release"){
                $("#author_div").css("display", "none");
                $("#auther").val("");
                $("#report_div").css("display", "none");
                $("#report_id").val("");
                $("#datepicker").removeClass("no-padd-left");
                $("#datepicker").removeClass("col-md-6");
                $("#datepicker").addClass("col-md-12");
            }else{
                $("#author_div").css("display", "block");
                $("#auther").val("{{ !empty($blog->auther)?$blog->auther:'' }}");
                $("#report_div").css("display", "block");
                // $("#report_id").val("");
                $("#datepicker").addClass("no-padd-left");
                $("#datepicker").addClass("col-md-6");
                $("#datepicker").removeClass("col-md-12");
            }
            $("#page_type").change(function(){
                if($(this).val() == "press_release"){
                    $("#author_div").css("display", "none");
                    $("#auther").val("");
                    $("#report_div").css("display", "none");
                    $("#report_id").val("");
                    $("#datepicker").removeClass("no-padd-left");
                    $("#datepicker").removeClass("col-md-6");
                    $("#datepicker").addClass("col-md-12");
                }else{
                    $("#author_div").css("display", "block");
                    $("#auther").val("{{ !empty($blog->auther)?$blog->auther:'' }}");
                    $("#report_div").css("display", "block");
                    // $("#report_id").val("");
                    $("#datepicker").addClass("no-padd-left");
                    $("#datepicker").addClass("col-md-6");
                    $("#datepicker").removeClass("col-md-12");
                }
            })
        })
    </script>

    <script>
        $(document).ready(function() {
            $('#slug_url').on('keydown', function(e) {
                var keyCode = e.keyCode || e.which;
                if (keyCode === 191) {
                    e.preventDefault();
                    return false;
                }
            });
            $("#slug_url").on('input', function(){
                $.ajax({
                    type: "get",
                    url: "{{ url('/admin/blog/check-blog-slug-url-exist') }}",
                    data: {
                        slug_url: $("#slug_url").val(), // Removed the semicolon here
                        blog_id: $("#blog_id").val(),
                        page_type: $("#page_type").val(),
                    },
                    success: function(response){
                        if(response.trim()){
                            $("#url_existence_message").removeClass("d-none");
                            $("#url_existence_message").html("<b>*</b> this url has already been taken");
                            $("#update_btn").attr("disabled", "diasbled");
                        } else {
                            $("#url_existence_message").addClass("d-none");
                            $("#url_existence_message").html("");
                            $("#update_btn").removeAttr("disabled");
                        }
                    }
                });
            });
        });
    </script>
  
@endsection
