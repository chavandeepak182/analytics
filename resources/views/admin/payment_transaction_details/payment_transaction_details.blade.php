@extends('admin.layout.layout')
@section("content")

<style>
    .content-wrapper {
        min-height: 0 !important;
    }

    table tbody tr td:nth-child(1),
    table tbody tr td:nth-child(2),
    table tbody tr td:nth-child(4),
    table tbody tr td:nth-child(5),
    table tbody tr td:nth-child(6),
    table tbody tr td:nth-child(4),
    table tbody tr td:nth-child(5) {
        text-align: center;
    }
    .content-header{
        margin-bottom: 15px;
    }
    .table-parent-div{
        overflow-x: auto;
    }
    .scrollable-cell {
        max-height: 100px; /* Adjust the max height as needed */
        overflow: auto;
        white-space: pre-line; /* Preserve line breaks */
    }
</style>
@php
    $role_id = Auth::guard('arm_admins')->user()->role_id;
    $RolesPrivileges = App\Models\Arm_role_privilege::where('status', 'active')->where('id', $role_id)->select('privileges')->first();
@endphp
<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row no-margin">
            <section class="content-header"> 
                <h1>Payment Transaction Details
                    <div class="pull-right">
                    @if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'payment_transaction_details_other'))
                        <a href="{{ url('admin/export-payment-details') }}">
                            <button style="background-color: #008d4c !important;" class="btn btn-success mb-4"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export All Payment Details</button>
                        </a> 
                    @endif
                    </div>
                </h1>
            </section>
            <section class="content" style="padding: 0px;">
                <div class="col-md-12 no-padd">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="row no-margin">
                                <div class="col-sm-12">
                                    <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 table-parent-div no-padd" style="overflow-x: auto;">
                                                <table id="arm_data_table" class="table table-bordered dataTable no-footer">
                                                    <thead>
                                                        <tr role="row">
                                                            <th >Sr. No.</th>
                                                            <th >Date & Time</th>
                                                            <th >Report Name</th>
                                                            <th >User Name</th>
                                                            <th >Email ID</th>
                                                            <th >Mobile No.</th>
                                                            <th >Payment Method</th>
                                                            <th >Payment Status</th>
                                                            <th >Payment ID</th>
                                                            <th >Amount</th>
                                                            <th >Licence Type</th>
                                                            <th >IP Address</th>
                                                            <th >Action</th>
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


<script src="{{ URL::asset('admin_panel/controller_js/cn_payment_details.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
    $(".s_meun").removeClass("active");
    // $(".cms_menu_active").addClass("active");
    $(".payment_transaction_details_active").addClass("active");
    $(".clear_btn").on("click", function() {
        location.reload();
    });
</script>

@endsection