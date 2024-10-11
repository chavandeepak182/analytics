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
                    Roles & Privileges
                    <div class="pull-right">
                        <a href="{{ url('admin/roles-privileges/create') }}" class="btn btn-success"><i class="fa fa-plus-circle"></i> Add Role</a>
                        {{-- @php 
                            $role_id = Illuminate\Support\Facades\Auth::guard('admin')->user()->role; 
                            $RolesPrevillages = App\Models\RolesPrevillages::where('status', '!=', 'delete') ->where('id', '=', $role_id) ->select('previllages')->first(); 
                        @endphp 
                        @if (str_contains($RolesPrevillages, 'roles_previllages_add'))
                            <a href="{{ url('admin/roles-previllages/create') }}" class="btn btn-sm btn-warning"><i class="fa fa-plus-circle"></i> Add Role</a>
                        @else
                            <a href="javascript:;" class="btn btn-sm btn-warning" disabled><i class="fa fa-check-circle"></i> Add Role</a>
                        @endif --}}
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
                                            <div class="col-sm-12 no-padd">
                                                <table id="arm_data_table" class="table table-bordered dataTable no-footer">
                                                    <thead>
                                                        <tr role="row">
                                                            <th width="10%">Sr. No.</th>
                                                            <th width="15%">Name</th>
                                                            <th width="45%">Privileges</th>
                                                            <th width="10%">Status</th>
                                                            <th width="10%">Action</th>
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

<script src="{{ URL::asset('admin_panel/controller_js/cn_roles_previllages.js')}}"></script>

<script type="text/javascript">
    $(".s_meun").removeClass("active");
    $(".system_user_active").addClass("active");
    $(".roles_privileges_active").addClass("active");
</script>

@endsection