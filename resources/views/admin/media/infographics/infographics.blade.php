@extends('admin.layout.layout')
@section('content')
    <!-- Infographics Starts -->
    <style>

        .table tbody tr td:nth-child(1),
        .table tbody tr td:nth-child(5),
        .table tbody tr td:nth-child(6),
        .table tbody tr td:nth-child(7) {
            text-align: center;
        }
    </style>
    @php
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = App\Models\Arm_role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();
    @endphp
    <div class="content-wrapper">
        <section class="content">
            <div class="row">
                <div class="col-md-12 ">
                    <section class="content-header" style="padding: 0 0px 15px 0;">
                        <h1>Infographics List
                            <div class="pull-right">
                            @if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'infographics_add'))
                                <a href="{{ url('admin/add-infographics') }}">
                                    <button type="button" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New </button>
                                </a>
                            @endif
                            </div>
                        </h1>
                    </section>
                    <div class="box box-primary">
                        <div class="box-body" style="min-height: 485px;">
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
                                                                        <th width="6%" class="text-center">Sr No.</th>
                                                                        <th width="15%">Title</th>
                                                                        <th width="15%">Link URL</th>
                                                                        {{-- <th width="20%">Description</th> --}}
                                                                        <th width="10%" class="text-center">Image</th>
                                                                        <th width="6%" class="text-center">Status</th>
                                                                        <th width="8%" class="text-center">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
{{-- 
                                                                {{-- <tr>
                                                                    <td>1</td>
                                                                    <td>Global Beef Jerky Market 2022 By Manufacturers, Regions</td>
                                                                    <td><a href="#">www.loremdummylink.com</a></td>
                                                                    {{-- <td>By 2030, the market for beef jerky is expected to expand significantly, with a rising CAGR.Beef Jerky: OverviewLean beef strips that have been salted and dried out until dry over a long period of time</td> --}}
                                                                    {{-- <td><img src="{{ URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" alt=""></td> 
                                                                    <td class="text-center">
                                                                        <a href="javascript:void(0);" class="change-status" flash="Product is made in-active" table="poona_product" status="1" ><i class="fa fa-toggle-on tgle-on " aria-hidden="true" title="Active"></i></a>
                                                                    </td> --}}
                                                                    {{-- <td><a href="javascript:void(0);"> <button type="button" data-id="" class="btn btn-primary btn-xs View_button" title="View"><i class="fa fa-eye"></i></button></a>  --}}
                                                                       {{-- <td> <a href="javascript:void(0);"> <button type="button" data-id="2" class="btn btn-warning btn-xs Edit_button" title="Edit"><i class="fa fa-pencil"></i></button></a>
                                                                        <a href="javascript:void(0);" data-id="2" data-table="blogs" data-flash="Blog Deleted Successfully!" class="btn btn-danger delete btn-xs" title="Delete"><i class="fa fa-trash"></i></a>
                                                                    </td>
                                                                </tr>  --}}

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
                    <!-- End box -->
                </div>
            </div>
            <!-- /.row -->
        </section>
    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('admin_panel/controller_js/cn_infographics.js') }}"></script> 

    <script type="text/javascript">
        $(".s_meun").removeClass("active");
        $(".media_menu_active").addClass("active");
        $(".media_infographics_active").addClass("active");

        $('.clear_btn').on('click', function() {
            location.reload();
        });
    </script>
@endsection
