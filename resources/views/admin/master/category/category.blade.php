@extends('admin.layout.layout')
@section("content")

<style>
    .content-wrapper {
        min-height: 0 !important;
    }

    table tbody tr td:nth-child(1),
    table tbody tr td:nth-child(3),
    table tbody tr td:nth-child(4),
    table tbody tr td:nth-child(5) {
        text-align: center;
    }

    .modal-dialog {
        width: 700px;
    }

    table {
        table-layout:fixed;
    }
    td{
        overflow:hidden;
        text-overflow: ellipsis;
    }
</style>

<div class="content-wrapper" style="min-height: 1086px;">
    <!-- Main content -->
    <section class="content">
        <div class="row no-margin">
            <div class="col-md-4 no-pad">
                <section class="content-header">
                    <h1>Add Category </h1>
                </section>
                <div class="box box-primary">
                    <div class="box-body light-green-body">
                        <form action="{{url('admin/category/store')}}" method="post" id="category_form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{!empty($reportCategory->id)?$reportCategory->id:''}}">
                                <input type="hidden" name="category_details" value="category_details">

                                <div class="col-md-12 form-group">
                                    <label>Category Name<span style="color: red;">*</span></label>
                                    <input type="text" name="category_name" id="category_name" class="form-control" value="{{!empty($reportCategory->category_name) ? $reportCategory->category_name : old('category_name');}}" autocomplete="off">
                                    @if($errors->has('category_name'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('category_name')}}</span>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Heading<span style="color: red;">*</span></label>
                                    <input type="text" name="heading" id="heading" class="form-control" value="{{!empty($reportCategory->heading) ? $reportCategory->heading : old('heading');}}" autocomplete="off">
                                    @if($errors->has('heading'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('heading')}}</span>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Content<span style="color: red;">*</span></label>
                                    <textarea class="form-control summernote" name="description" id="description">{{!empty($reportCategory->description) ? $reportCategory->description : '';}}</textarea>
                                    @if($errors->has('description'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('description')}}</span>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Upload Image <small class="text-danger">( 409 * 235 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                    <input type="file" class="form-control preview" id="image_path" name="image_path" accept=".jpg,.jpeg,.bmp,.png,">
                                    <div class="clearfix"></div>
                                    <img src="{{!empty($reportCategory->image_path) && Storage::exists($reportCategory->image_path) ? url('/').Storage::url($reportCategory->image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image" alt="{{!empty($reportCategory->image_name) ? $reportCategory->image_name : 'User Image';}}">
                                    @if($errors->has('image_path'))
                                    <span class="text-danger"><b>* Image Type Must Be Jpg,Jpeg,Png</b></span>
                                    @endif
                                </div>
                                <input type="hidden" class="form-control" id="meta_title" name="meta_title" value="{{ !empty($reportCategory->meta_title) ? $reportCategory->meta_title : old('meta_title') }}">
                                <input type="hidden" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ !empty($reportCategory->meta_keyword) ? $reportCategory->meta_keyword : old('meta_keyword') }}">
                                <input type="hidden" class="form-control" id="meta_description" name="meta_description" value="{{ !empty($reportCategory->meta_description) ? $reportCategory->meta_description : old('meta_description') }}">

                            </div>


                            <!-- End form-group -->
                            <div class="clearfix"></div>

                            <div class="col-md-12 form-group no-padd">
                                <button type="submit" class="btn btn-success submit"><i class="fa fa-check-circle"></i>
                                {{ !empty($reportCategory) ? 'Update' : 'Add' }}
                                </button>
                                <button type="reset" class="btn btn-danger cancel-btn"><i class="fa fa-times-circle"></i> Clear</button>
                            </div>
                        </form>
                        <!-- End form-group -->
                    </div>
                    <!-- End box-body -->
                </div>
                <!-- End box -->
            </div>
            <div class="col-md-8 no-pad-right">
                <section class="content-header">
                    <h1>Category List </h1>
                </section>
                <div class="box box-primary">
                    <div class="box-body">
                        <div class="row no-margin">
                            <div class="col-sm-12">
                                <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                    <div class="row">
                                        <div class="col-sm-12 no-padd">
                                            <table id="arm_data_table" class="table table-bordered dataTable no-footer" role="grid" aria-describedby="example_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th width="10%" class="text-center">Sr. No.</th>
                                                        <th width="50%" class="">Category</th>
                                                        <th width="15%" class="">Image</th>
                                                        <th width="10%" class="text-center">Status</th>
                                                        <th width="15%" class="text-center">Action</th>
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
                    </div>
                </div>
                <!-- End box -->
            </div>

            <div class="col-md-12 no-pad">
                <section class="content-header">
                    <h1>Add Meta Details </h1>
                </section>
                <div class="box box-primary">
                    <div class="box-body light-green-body" style="min-height: 260px;">
                        <form action="{{url('admin/category/store')}}" method="post" id="category_form" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <input type="hidden" name="id" value="{{!empty($reportCategory->id)?$reportCategory->id:''}}">
                                <input type="hidden" name="category_name" id="category_name" class="form-control" value="{{!empty($reportCategory->category_name) ? $reportCategory->category_name : old('category_name');}}" autocomplete="off">
                                <input type="hidden" name="heading" id="heading" class="form-control" value="{{!empty($reportCategory->heading) ? $reportCategory->heading : old('heading');}}" autocomplete="off">
                                <input type="hidden" name="description" id="description" class="form-control" value="{{!empty($reportCategory->description) ? $reportCategory->description : ''}}" autocomplete="off">

                                <div class="col-md-12 form-group">
                                    <label class="lablefnt">Meta Description</label>
                                    <input type="text" class="form-control" id="meta_description" name="meta_description" value="{{ !empty($reportCategory->meta_description) ? $reportCategory->meta_description : old('meta_description') }}">
                                    @if($errors->has('meta_description'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('meta_description')}}</span>
                                    @endif
                                </div>

                                <div class="col-md-12 form-group">
                                    <label class="lablefnt">Meta Keyword</label>
                                    <input type="text" class="form-control" id="meta_keyword" name="meta_keyword" value="{{ !empty($reportCategory->meta_keyword) ? $reportCategory->meta_keyword : old('meta_keyword') }}">
                                    @if($errors->has('meta_keyword'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('meta_keyword')}}</span>
                                    @endif
                                </div>

                                <div class="col-md-12 form-group">
                                    <label class="lablefnt">Meta Title</label>
                                    <input type="text" class="form-control" id="meta_title" name="meta_title" value="{{ !empty($reportCategory->meta_title) ? $reportCategory->meta_title : old('meta_title') }}">
                                    @if($errors->has('meta_title'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('meta_title')}}</span>
                                    @endif
                                </div>
                            </div>


                            <!-- End form-group -->
                            <div class="clearfix"></div>

                            <div class="col-md-12 form-group no-padd">
                                <button type="submit" class="btn btn-success submit" {{ !empty($reportCategory) ? 'enabled' : 'disabled' }}><i class="fa fa-check-circle"></i>
                                {{ !empty($reportCategory) ? 'Update' : 'Add' }}
                                </button>
                                <a href="{{url('admin/category')}}" class="btn btn-danger cancel-btn"><i class="fa fa-times-circle"></i> Cancel</a>
                            </div>
                        </form>
                        <!-- End form-group -->
                    </div>
                    <!-- End box-body -->
                </div>
                <!-- End box -->
            </div>
        </div>
        <!-- End box -->
    </section>
</div>


    @endsection
    @section('script')

    <script src="{{ URL::asset('admin_panel/controller_js/cn_report_category.js')}}"></script>

    <script>
        $(".s_meun").removeClass("active");
        $(".master_active").addClass("active");
        $(".master_category_active").addClass("active");
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