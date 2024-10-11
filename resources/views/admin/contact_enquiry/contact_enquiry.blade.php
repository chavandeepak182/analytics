@extends('admin.layout.layout')
@section("content")

<style>
    .content-wrapper {
        min-height: 0 !important;
    }

    table tbody tr td:nth-child(1),
    table tbody tr td:nth-child(7) {
        text-align: center;
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
                <h1>Enquiry List 
                    <div class="pull-right">
                    @if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'contact_enquiry_other'))
                        <a href="{{ url('admin/export/contact-us') }}">
                            <button style="background-color: #008d4c !important;" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export All Contact Enquiry</button>
                        </a> 
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
                                                            <th width="5%" class="text-center">Sr. No.</th>
                                                            <th width="10%" class="">Date</th>
                                                            <th width="15%" class="">Name</th>
                                                            <th width="10%" class="">Phone No.</th>
                                                            <th width="10%" class="">Email</th>
                                                            <th width="10%" class="">Company</th>
                                                            <th width="30%" class="">Message</th>
                                                            <th width="5%" class="">IP Adress</th>
                                                            <th width="5%" class="text-center">Action</th>
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

<script src="{{ URL::asset('admin_panel/controller_js/cn_contact_us.js')}}"></script>

<script type="text/javascript">
    $(".s_meun").removeClass("active");
    $(".contact_enquiery_active").addClass("active");
    $(".clear_btn").on("click", function() {
        location.reload();
    });
</script>

@endsection



