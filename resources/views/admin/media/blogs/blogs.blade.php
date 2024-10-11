@extends('admin.layout.layout')
@section('content')
    <!-- Blogs Starts -->
    <style>
        .table tbody tr td:nth-child(1),
        .table tbody tr td:nth-child(4),
        .table tbody tr td:nth-child(5),
        .table tbody tr td:nth-child(6),
        .table tbody tr td:nth-child(7),
        .table tbody tr td:nth-child(8) {
            text-align: center;
        }
    </style>
    @php
        $role_id = Auth::guard('arm_admins')->user()->role_id;
        $RolesPrivileges = App\Models\Arm_role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();
    @endphp
    <div class="content-wrapper blogs-section">
        <section class="content">
            <div class="row">
                <div class="col-md-12 ">
                    <section class="content-header" style="padding: 0 0px 15px 0;">
                        <h1>Blogs / Press Release List
                            <div class="pull-right">
                            @if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'blog_press_release_add'))
                                <a href="{{ url('admin/add-blogs') }}">
                                    <button type="button" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add New </button>
                                </a>
                            @endif
                            </div>
                        </h1>
                    </section>
                    <div class="box box-primary" style="background: #fff;">
                        <div class="box-body no-height">
                            <div class="row">
                                <form method="get">
                                    <div class="col-sm-3 form-group ">
                                        <label>Select Type</label>
                                        <select class="form-control w-100" id="page_type" name="page_type">
                                            <option value="">Select</option>
                                            <option value="blogs">Blogs</option>
                                            <option value="press_release">Press Release</option>
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
                                                                        <th width="5%" class="text-center">Sr No.</th>
                                                                        <th width="15%">Title</th>
                                                                        <th width="15%">Type</th>
                                                                        <th width="30%" class="text-center">Description</th>
                                                                        <th width="8%" class="text-center">Date</th>
                                                                        <th width="8%" class="text-center">Image</th>
                                                                        <th width="4%" class="text-center">Status</th>
                                                                        <th width="10%" class="text-center">Action</th>
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
<script src="{{ URL::asset('admin_panel/controller_js/cn_blog.js') }}"></script>
<script type="text/javascript">
        $(".s_meun").removeClass("active");
        $(".media_menu_active").addClass("active");
        $(".media_blogs_active").addClass("active");
        $('.clear_btn').on('click', function() {
            location.reload();
        });
</script>
@endsection
