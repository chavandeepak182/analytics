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
                    <h1>Research Methodology
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
                                    <form action="{{route('research.methodology.store')}}" class="form-validate is-alter"  method="POST" id="system_users_form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{!empty($research->id)?$research->id:''}}">
                                      
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-sm-12 form-group">
                                                    <label>Heading<span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="section_1_heading" name="section_1_heading"   value="{{old('section_1_heading',!empty($research->section_1_heading)?$research->section_1_heading:'')}}" >
                                                </div>
                                                <div class="col-sm-12 form-group">
                                                    <label>Description<span style="color: red;">*</span></label>
                                                    <textarea class="form-control summernote" name="section_1_description" id="section_1_description" value={{old('section_1_description')}}>{{!empty($research->section_1_description)?$research->section_1_description:''}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-10">
                                            <button type="submit" name="section_1" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i>{{!empty($research->id) ? 'Update' : 'Add'}}</button>
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
                                            <h1>Section 2</h1>
                                        </section>
                                    </div>
                                    <form action="{{route('research.methodology.store')}}" class="form-validate is-alter" autocomplete="off" method="POST" id="system_users_form" enctype="multipart/form-data">
                                           @csrf
                                        <input type="hidden" name="id" value="{{!empty($research->id)?$research->id:''}}">
                                       
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-sm-12 form-group">
                                                    <label>Heading<span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="section_2_heading" name="section_2_heading" value="{{old('section_2_heading',!empty($research->section_2_heading)?$research->section_2_heading:'')}}" >
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-md-12 form-group">
                                                    <label>Description<span style="color: red;">*</span></label>
                                                    <textarea class="form-control summernote" name="section_2_description" id="section_2_description" value={{old('section_2_description')}} >{{!empty($research->section_2_description)?$research->section_2_description:''}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-30 mb-30">
                                            <button type="submit" name="section_2" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i> {{!empty($research->id) ? 'Update' : 'Add'}}</button>
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
                                            <h1>Section 3</h1>
                                        </section>
                                    </div>
                                    <form action="{{route('research.methodology.store')}}" class="form-validate is-alter" autocomplete="off" method="POST" id="system_users_form" enctype="multipart/form-data">
                                           @csrf
                                          <input type="hidden" name="id" value="{{!empty($research->id)?$research->id:''}}">
                                       
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-sm-12 form-group">
                                                    <label>Heading<span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="section_3_heading" name="section_3_heading" value="{{old('section_3_heading',!empty($research->section_3_heading)?$research->section_3_heading:'')}}" >
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-md-12 form-group">
                                                    <label>Description<span style="color: red;">*</span></label>
                                                    <textarea class="form-control summernote" name="section_3_description" id="section_3_description" value={{old('section_3_description')}} >{{!empty($research->section_3_description)?$research->section_3_description:''}}</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-12 mt-30 mb-30">
                                            <button type="submit" name="section_3" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i> {{!empty($research->id) ? 'Update' : 'Add'}}</button>
                                            <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- End box -->
                    </div>
                    <!-- Section 3 -->

                    <!-- Section 4 -->
                    <div class="col-md-12 no-pad">
                        <div class="box box-primary">
                            <div class="box-body">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <section class="content-header">
                                            <h1>Section 4</h1>
                                        </section>
                                    </div>
                                    <form action="{{route('research.methodology.store')}}" class="form-validate is-alter" autocomplete="off" method="POST" id="system_users_form" enctype="multipart/form-data">
                                           @csrf
                                        <input type="hidden" name="id" value="{{!empty($research->id)?$research->id:''}}">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-sm-12 form-group">
                                                    <label>Heading<span style="color: red;">*</span></label>
                                                    <input type="text" class="form-control" id="section_4_heading" name="section_4_heading" value="{{old('section_4_heading',!empty($research->section_4_heading)?$research->section_4_heading:'')}}" >
                                                </div>
                                                <div class="clearfix"></div>
                                                <div class="col-md-12 form-group">
                                                    <label>Description 1<span style="color: red;">*</span></label>
                                                    <textarea class="form-control summernote" name="section_4_description_1" id="section_4_description_1" value={{old('section_4_description_1')}} >{{!empty($research->section_4_description_1)?$research->section_4_description_1:''}}</textarea>
                                                </div>
                                                <!-- <div class="col-md-12">
                                                    <div class="section-two-line"></div>
                                                </div> -->
                                                <div class="col-md-8 form-group">
                                                    <label>Description 2<span style="color: red;">*</span></label>
                                                    <textarea class="form-control summernote" name="section_4_description_2" id="section_4_description_2" value={{old('section_4_description_2')}} >{{!empty($research->section_4_description_2)?$research->section_4_description_2:''}}</textarea>
                                                </div>
                                                <div class="col-md-4 form-group">
                                                    <label>Upload Image <small class="text-danger">( 467 * 311 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                                    <input type="file" class="form-control preview" id="section_4_image_path_1" name="section_4_image_path_1" value="{{old('section_4_image_path_1')}}" accept=".jpg,.jpeg,.bmp,.png,">

                                                    <input type="hidden" name="old_profile_image" id="old_profile_image" value="{{!empty($research->section_4_image_path_1) ?$research->section_4_image_path_1: '';}}" class="form-control preview">
                                                    <div class="clearfix"></div>
                                                    <img src="{{!empty($research->section_4_image_path_1) ?url('/').Storage::url($research->section_4_image_path_1) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image" alt="{{!empty($research->section_4_image_name_1) ? $research->section_4_image_name_1: 'Default Image';}}">
                                                    <div class="clearfix"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 no-pad">
                                            <div class="col-md-12 form-group">
                                                <label>Sub Heading 1 <span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" id="section_4_sub_heading_1" name="section_4_sub_heading_1" value="{{old('section_4_sub_heading_1',!empty($research->section_4_sub_heading_1)?$research->section_4_sub_heading_1:'')}}" >
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Sub Description 1<span style="color: red;">*</span></label>
                                                <textarea class="form-control summernote" name="section_4_sub_description_1" id="section_4_sub_description_1" value={{old('section_4_sub_description_1')}} >{{!empty($research->section_4_sub_description_1)?$research->section_4_sub_description_1:''}}</textarea>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Upload Image <small class="text-danger">( 84 * 95 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                                <input type="file" class="form-control preview1" id="section_4_image_path_2" name="section_4_image_path_2" value="{{old('section_4_image_path_2')}}" accept=".jpg,.jpeg,.bmp,.png,">

                                                <input type="hidden" name="old_profile_image" id="old_profile_image" value="{{!empty($research->section_4_image_path_2) ? $research->section_4_image_path_2: '';}}" class="form-control preview">
                                                <div class="clearfix"></div>

                                                <img src="{{!empty($research->section_4_image_path_2) ?url('/').Storage::url($research->section_4_image_path_2) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image1" alt="{{!empty($research->section_4_image_name_2) ? $research->section_4_image_name_2: 'Default Image';}}">
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 no-pad">
                                            <div class="col-md-12 form-group">
                                                <label>sub Heading 2<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" id="section_4_sub_heading_2" name="section_4_sub_heading_2" value="{{old('section_4_sub_heading_2',!empty($research->section_4_sub_heading_2)?$research->section_4_sub_heading_2:'')}}" >
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Sub Description 2<span style="color: red;">*</span></label>
                                                <textarea class="form-control summernote" name="section_4_sub_description_2" id="section_4_sub_description_2" value={{old('section_4_sub_description_2')}} >{{!empty($research->section_4_sub_description_2)?$research->section_4_sub_description_2:''}}</textarea>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Upload Image <small class="text-danger">( 84 * 95 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                                <input type="file" class="form-control preview2" id="section_4_image_path_3" name="section_4_image_path_3" value="{{old('section_4_image_path_3')}}" accept=".jpg,.jpeg,.bmp,.png,">

                                                <input type="hidden" name="old_profile_image" id="old_profile_image" value="{{!empty($research->section_4_image_path_3) ? $research->section_4_image_path_3: '';}}" class="form-control preview">
                                                <div class="clearfix"></div>
                                                <img src="{{!empty($research->section_4_image_path_3) ?url('/').Storage::url($research->section_4_image_path_3) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image2" alt="{{!empty($research->section_4_image_name_3) ? $research->section_4_image_name_3 : 'Default Image';}}">
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 no-pad">
                                            <div class="col-md-12 form-group">
                                                <label>Sub Heading 3<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" id="section_4_sub_heading_3" name="section_4_sub_heading_3" value="{{old('section_4_sub_heading_3',!empty($research->section_4_sub_heading_3)?$research->section_4_sub_heading_3:'')}}" >
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Sub Description 3<span style="color: red;">*</span></label>
                                                <textarea class="form-control summernote" name="section_4_sub_description_3" id="section_4_sub_description_3" value={{old('section_4_sub_description_3')}} >{{!empty($research->section_4_sub_description_3)?$research->section_4_sub_description_3:''}}</textarea>
                                            </div>
                                            <div class="col-md-12 form-group">
                                                <label>Upload Image <small class="text-danger">( 84 * 95 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                                <input type="file" class="form-control preview3" id="section_4_image_path_4" name="section_4_image_path_4" value="{{old('section_4_image_path_3')}}" accept=".jpg,.jpeg,.bmp,.png,">

                                                <input type="hidden" name="old_profile_image" id="old_profile_image" value="{{!empty($research->section_4_image_path_4) ? $research->section_4_image_path_4: '';}}" class="form-control preview">
                                                <div class="clearfix"></div>
                                                <img src="{{!empty($research->section_4_image_path_4) ?url('/').Storage::url($research->section_4_image_path_4) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image3" alt="{{!empty($research->section_4_image_name_4) ? $research->section_4_image_name_4: 'Default Image';}}">
                                                <div class="clearfix"></div>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12 mt-30 mb-30">
                                            <button type="submit" name="section_4" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i> {{!empty($research->id) ? 'Update' : 'Add'}}</button>
                                           <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- End box -->
                    </div>
                    <!-- Section 4 -->

                    <!-- Section 5 -->
                    <div class="col-md-12 no-pad">
                        <div class="box box-primary">
                            <div class="box-body" style="min-height: 180px;">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <section class="content-header">
                                            <h1>Section 5</h1>
                                        </section>
                                    </div>
                                    <form action="{{route('research.methodology.banner.store')}}" class="form-validate is-alter" autocomplete="off" method="POST" id="system_users_form" enctype="multipart/form-data">
                                           @csrf
                                        
                                        <div class="col-sm-4 form-group">
                                            <div class="multiple-img-upload">
                                                <div class="form-group mt-5">
                                                    <label for="">Choose Banner Images<small class="text-danger">( 761 * 522 , Only jpg,png &amp; jpeg format)</small></label>
                                                    <input type="file" class="form-control" name="image_path[]" multiple id="upload-img" />
                                                </div>
                                            </div> 
                                                <div class="img-thumbs" id="">

                                                    @if (!empty($banner))
                                                    @foreach($banner as $bannerData)
                                                    <div class="wrapper-thumb" id="img_div_{{!empty($bannerData->id) ? ($bannerData->id) : '';}}">
                                                        <img src="{{!empty($bannerData->image_path) ? url('/').Storage::url($bannerData->image_path) : '';}}" class="" alt="{{!empty($bannerData->image_name) ? $bannerData->image_name : 'Banner Image';}}">
                                                        <span class="remove-btn" style="color:red;" onclick="deleteBannerImage({{!empty($bannerData->id) ? ($bannerData->id) : ''}})">x</span>
                                                    </div>
                                                    @endforeach

                                                    @endif
                                                </div> 
                                            <div class="upload-multiple-div img-thumbs-hidden" id="img-preview"></div>
                                        </div>

                                        <div class="col-md-12 mt-30 mb-30">
                                            <button type="submit" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i> Submit</button>
                                           <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div> <!-- End box -->
                    </div>
                    <!-- Section 5 -->
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

<script>
    var imgUpload = document.getElementById('upload-img')
  , imgPreview = document.getElementById('img-preview')
  , imgUploadForm = document.getElementById('form-upload')
  , totalFiles
  , previewTitle
  , previewTitleText
  , img;

imgUpload.addEventListener('change', previewImgs, true);

function previewImgs(event) {
  totalFiles = imgUpload.files.length;
  
     if(!!totalFiles) {
    imgPreview.classList.remove('img-thumbs-hidden');
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
 function deleteBannerImage(banner_image_id) {
    if (banner_image_id!= "") {
        if (confirm("Do you really want to delete this image ?")) {
            $.ajax({
                url: base_url + "/admin/research-methodology-banner-image",
                
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