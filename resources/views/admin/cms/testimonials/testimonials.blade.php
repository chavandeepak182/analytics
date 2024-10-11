@extends('admin.layout.layout')
@section("content")

<style>
    .content-wrapper {
        min-height: 0 !important;
    }

    table tbody tr td:nth-child(1),
    table tbody tr td:nth-child(4),
    table tbody tr td:nth-child(5),
    table tbody tr td:nth-child(6),
    table tbody tr td:nth-child(7),
    table tbody tr td:nth-child(8),
    table tbody tr td:nth-child(9) {
        text-align: center;
    }
    table tbody td img {
    width: 75px;
}
textarea.form-control {
    height: 200px;
}
</style>

<div class="content-wrapper" style="min-height: 1086px;">
    <!-- Main content -->
    <section class="content">
        <div class="row no-margin">
            <section class="content-header mb-5">
                <h1 >Testimonials List
                    <!-- <div class="pull-right">
                        <a href="{{url('/admin/add-testimonials')}}" class="btn btn-success"><i class="fa fa-plus"></i> Add New</a>
                    </div> -->
                </h1>
            </section>
            <div class="col-md-4 no-pad">
                <div class="box box-primary">
                    <div class="box-body light-green-body">
                        <div class="row">
                             <form action="{{route('testimonial.store')}}" class="form-validate is-alter"  method="POST" id="system_users_form" enctype="multipart/form-data">
                                @csrf
                            <input type="hidden" name="id" value="{{!empty($testimonial->id)?$testimonial->id:''}}">
                            <div class="col-md-12 form-group">
                                <label>Name<span style="color: red;">*</span></label>
                                <input type="text" class="form-control" name="name" id="name" value="{{old('name',!empty($testimonial->name)?$testimonial->name:'')}}">
                                @if($errors->has('name'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('name')}}</span>
                                @endif
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Designation<span style="color: red;">*</span></label>
                                <input type="text" class="form-control " name="designation" id="designation" value="{{old('designation',!empty($testimonial->designation)?$testimonial->designation:'')}}">
                                @if($errors->has('designation'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('designation')}}</span>
                                @endif
                            </div>

                            <div class="col-md-12 form-group">
                                <label>Description<span style="color: red;">*</span></label>
                                <textarea name="description" class="form-control" id="description" data-gramm="false" wt-ignore-input="true" value={{old('description')}} >{{!empty($testimonial->description)?$testimonial->description:''}}</textarea>
                                @if($errors->has('description'))
                                    <span class="text-danger"><b>*</b> {{$errors->first('description')}}</span>
                                @endif
                            </div>

                            <div class="col-md-12 form-group">
                                <div class="upload_img">
                                    <label>Upload Image<span style="color: red;">* <small class="text-danger">(size:80*80)(.jpg, .jpeg, .png)</small></span></label>
                                    <input type="file" class="form-control preview" id="image_path" name="image_path" accept="image/*">
                                    <img src="{{!empty($testimonial->image_path) && Storage::exists($testimonial->image_path) ? url('/').Storage::url($testimonial->image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image" alt="{{!empty($testimonial->image_name) ? $testimonial->image_name : 'User Image';}}">
                                    @if($errors->has('image_path'))
                                        <span class="text-danger"><b>* {{$errors->first('image_path')}} </b></span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 form-group">
                                <button type="submit" class="btn btn-success save_btn submit" data-id="submit"><i class="fa fa-check-circle"></i>{{!empty($testimonial->id) ? 'Update' : 'Add'}}</button>
                                <a href=""> <button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-8 no-pad-right">
                <div class="box box-primary">
                    <div class="box-body light-green-body">
                        <div class="table-responsive">
                            <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="arm_data_table" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example_info" style="width: 1092px;">
                                            <thead>
                                                <tr role="row">
                                                    <th width="9%" class="text-center">Sr No.</th>
                                                    <th width="18%">Name</th>
                                                    <th width="17%" class="text-center">Designation</th>
                                                    <th width="25%">Description</th>
                                                    <th width="14%" class="text-center">Profile Image</th>                                                        
                                                    <th width="6%" class="text-center">Status</th>
                                                    <th width="11%" class="text-center">Action</th>
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
        </div>
        <!-- End box -->
    </section>
</div>


@endsection
@section('script')
<script src="{{ URL::asset('admin_panel/controller_js/cn_testimonial.js')}}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
    $(".s_meun").removeClass("active");
    $(".cms_menu_active").addClass("active");
    $(".testimonials_active").addClass("active");
    $(".clear_btn").on("click", function() {
        location.reload();
    });
</script>
@endsection