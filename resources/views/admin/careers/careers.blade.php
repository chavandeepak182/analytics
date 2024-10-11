@extends('admin.layout.layout')
@section('content')
    <!-- International Council Starts -->
    <style>
        .box .box-body .dataTables_wrapper .table tbody tr td:nth-child(1),
        .box .box-body .dataTables_wrapper .table tbody tr td:nth-child(3),
        .box .box-body .dataTables_wrapper .table tbody tr td:nth-child(4),
        .box .box-body .dataTables_wrapper .table tbody tr td:nth-child(5),
        .box .box-body .dataTables_wrapper .table tbody tr td:nth-child(6) {
            text-align: center;
        }

    </style>

    <div class="content-wrapper careers">

        <!-- Main content -->
        <section class="content ">
            <div class="row no-margin">
                <div class="col-md-12 no-pad">
                    <section class="content-header">
                        <h1>Careers</h1>
                    </section>

                    <div class="col-md-12 no-pad">
                        <div class="box box-primary">
                            <div class="box-body light-green-body" style="min-height: 180px;">
                                <form action="{{route('career.store')}}" method="post" id="category_form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="id" value="{{!empty($career->id)?$career->id:''}}">
                                    <div class="row">
                                        <div class="col-sm-12 form-group">
                                            <label>Heading<span style="color: red;">*</span></label>
                                            <input type="text" class="form-control" id="heading" name="heading" value="{{old('heading',!empty($career->heading)?$career->heading:'')}}" >
                                        </div>
                                        <div class="col-md-12 form-group">
                                            <label>Description<span style="color: red;">*</span></label>
                                            <textarea class="form-control summernote" name="description" id="description">{{!empty($career->description)?$career->description:''}}</textarea>
                                        </div>
                                        <div class="col-md-12">
                                            <button type="submit" id="submit_btn" class="btn btn-success save_btn submit sub-btn "><i class="fa fa-check-circle"></i>{{!empty($career)?'Update':'Add'}}</button>
                                             <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!-- Our Team -->
                    <div class="col-md-4 no-padd">
                        <section class="content-header">
                            <h1>Add Careers</h1>
                        </section>
                        <section class="content " style="padding:0px 0px;">
                            <div class="box box-primary">
                                <div class="box-body light-green-body" style="min-height:480px">
                                    <form action="{{route('openings.store')}}" method="post" id="careers_form" enctype="multipart/form-data">
                                        @csrf
                                        <input type="hidden" name="id" value="{{!empty($openings->id)?$openings->id:''}}">
                                        <div class="col-md-12 no-padd">

                                            <div class="col-md-12 form-group no-padd">
                                                <label>Heading<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" autocomplete="off"
                                                    name="heading" id="heading" value="{{old('heading',!empty($openings->heading)?$openings->heading:'')}}" >
                                            </div>
                                            <div class="col-md-12 form-group no-padd">
                                                <label>Experience<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" autocomplete="off" name="experience"
                                                    id="experience" value="{{old('experience',!empty($openings->experience)?$openings->experience:'')}}">
                                            </div>
                                            <div class="col-md-12 form-group no-padd">
                                                <label>Total Position<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" autocomplete="off" name="number_of_positions"
                                                    id="number_of_positions" value="{{old('number_of_positions',!empty($openings->number_of_positions)?$openings->number_of_positions:'')}}">
                                            </div>
                                            <div class="col-md-12 form-group no-padd">
                                                <label>Location<span style="color: red;">*</span></label>
                                                <input type="text" class="form-control" autocomplete="off" name="location"
                                                    id="location" value="{{old('location',!empty($openings->location)?$openings->location:'')}}">
                                            </div>
                                        </div>

                                        <div class="col-md-12 form-group no-padd btn-pt-10">
                                            <div class="buttons">
                                                <button type="submit" class="btn btn-success save_btn submit"
                                                    data-id="submit">
                                                    <i class="fa fa-check-circle"></i>
                                                     {{!empty($openings)?'Update':'Add'}}
                                                </button>

                                                 <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                                            </div>
                                        </div>
                                    </form>


                                </div>
                            </div>
                        </section>

                    </div>
                    <div class="col-md-8 no-padd-right">
                        <section class="content-header">
                            <h1>Careers List</h1>
                        </section>
                        <section class="content" style="padding:0px 0px;">
                            <!-- <div class="col-md-12 no-pad"> -->
                            <div class="box box-primary">
                                <div class="box-body" style="min-height:480px">
                                    <div class="row no-margin">
                                        <div class="col-sm-12 no-pad">
                                            <div class="">
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div id="example_wrapper"
                                                            class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                                            <div class="row">
                                                                <div class="col-sm-12">
                                                                    <table id="arm_data_table"
                                                                        class="table table-bordered yajra-datatable dataTable no-footer"
                                                                        role="grid" aria-describedby="example_info">
                                                                        <thead>
                                                                            <tr role="row">
                                                                                <th width="9%" class="text-center">Sr No.</th>
                                                                                <th width="28%">Heading</th>
                                                                                <th width="15%" class="text-center">Total Position</th>
                                                                                <th width="14%" class="text-center">Experience</th>
                                                                                <th width="11%" class="text-center">Location</th>
                                                                                <th width="8%" class="text-center">Status</th>
                                                                                <th width="15%" class="text-center">Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            {{-- <tr>
                                                                                <td>1</td>
                                                                                <td>Business Development Executive</td>
                                                                                <td>12</td>
                                                                                <td>2.5 Years</td>
                                                                                <td>Pune</td>
                                                                                <td>
                                                                                    <a href="javascript:void(0)" data-flash="Status Changed Successfully!" class="change-status">
                                                                                        <i class="fa fa-toggle-on tgle-on  status_button" aria-hidden="true" title=""></i>
                                                                                    </a>
                                                                                </td>
                                                                                <td>
                                                                                    <a href="javascript:void(0)"> <button type="button" data-id="" class="btn btn-primary btn-xs View_button" title="View"><i class="fa fa-eye"></i></button></a>
                                                                                    <a href="javascript:void(0)"> <button type="button" data-id="31" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>                
                                                                                    <a href="javascript:void(0)" data-id="31" data-table="careers" data-flash="Member Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>
                                                                                </td>
                                                                            </tr> --}}

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
                                </div>
                                <!-- End box-body -->
                            </div>
                            <!-- End box-body -->
                            <!-- </div>  -->
                            <!-- End box -->
                        </section>


                    </div>
                    <!-- Our Team -->

                </div>
            </div>
            <!-- End box-body -->
        </section>
    </div>
@endsection



@section('script')
    <script src="{{ URL::asset('admin_panel/controller_js/cn_careers.js') }}"></script>

    <script type="text/javascript">
        $(".s_meun").removeClass("active");
        // $(".careers_active").addClass("active");
        $(".careers_active").addClass("active");

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
