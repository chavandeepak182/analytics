@extends('admin.layout.layout')
@section("content")
<style>
    .content-wrapper {
        min-height: 0 !important;
    }

    table tbody tr td:nth-child(1),
    table tbody tr td:nth-child(2),
    table tbody tr td:nth-child(3),
    table tbody tr td:nth-child(4),
    table tbody tr td:nth-child(5),
    table tbody tr td:nth-child(6),
    table tbody tr td:nth-child(7),
    {
        text-align: center;
    }

    .scrollable-cell {
        max-height: 100px; /* Adjust the max height as needed */
        overflow: auto;
        white-space: pre-line; /* Preserve line breaks */
    }
</style>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row no-margin">
            <section class="content-header">
                <h1>
                    System User
                    <div class="pull-right">
                        @php 
                            $role_id = Illuminate\Support\Facades\Auth::guard('arm_admins')->user()->role_id; 
                            $RolesPrevillages = App\Models\Arm_role_privilege::where('status', 'active') ->where('id', $role_id) ->select('privileges')->first(); 
                        @endphp 
                        @if (str_contains($RolesPrevillages, 'user_add'))
                            <a href="{{ url('admin/system-user/create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add User</a>
                        @endif 
                    </div>
                </h1>
                
            </section>
            <section class="content" style="padding:5px 0px;">
                <div class="col-md-12 no-padd">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="row no-margin">
                                <div class="col-sm-12">
                                    <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 no-padd" style="overflow-x: auto;">
                                                <table id="arm_data_table" class="table table-bordered dataTable no-footer">
                                                    <thead>
                                                        <tr role="row">
                                                        <th class="sort" data-sort="srno" style="min-width:45px">Sr No</th>
                                                        <th class="sort" style="min-width: 250px;" data-sort="number">Name</th>
                                                        <th class="sort" style="min-width: 250px;" data-sort="email">Email ID</th>
                                                        <th class="sort" style="min-width: 250px;" data-sort="email">Role</th>
                                                        <th class="sort" style="min-width: 100px;" data-sort="mobileno">Mobile No</th>
                                                        <th class="sort" style="min-width: 40px;" data-sort="status">Status</th>
                                                        <th class="sort" style="min-width:70px;text-align:center">Action</th>
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
            </section>
        </div>
        <!-- End box -->
    </section>
</div>

@endsection
@section('script')

<script src="{{ URL::asset('admin_panel/controller_js/cn_system_user.js')}}"></script>

<script type="text/javascript">
    $(".s_meun").removeClass("active");
    $(".system_user_active").addClass("active");
    $(".user_list_active").addClass("active");
</script>

@endsection