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
            <form action="{{url('admin/enquiry-export')}}" method="post">
            @csrf
            <section class="content-header">
                <h1>Enquiry List
                    <div class="pull-right">
                    @if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'enquiries_other'))
                        <button style="background-color: #008d4c !important;" type="submit"  class="btn btn-success export"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Enquiry</button>
                    @endif
                    </div>
                </h1>
            </section>
            <section class="content" style="padding:5px 0px;">
                <div class="col-md-12 no-pad" style="display: block;">
                    <div class="box box-primary" style="background: #fff;">
                        <div class="box-body no-height">
                            <div class="row">
                                    <div class="col-sm-3 form-group ">
                                        <label>Category</label>
                                        <select class="form-control w-100" id="request_type" name="request_type">
                                            <option value="">All</option>
                                            @foreach(config('constant.request_type_slug') as $key => $value){
                                                <option value="{{ $key }}">{{ $value }}</option>
                                            }
                                            @endforeach
                                        </select>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
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
                                                            <th class="text-center">Sr. No.</th>
                                                            <th class="">Request Type</th>
                                                            <th class="">Report Name</th>
                                                            <th class="">Date</th>
                                                            <th class="">Name</th>
                                                            <th class="">Email</th>
                                                            <th class="">Phone No.</th>
                                                            <th class="">Company</th>
                                                            <th class="">Massage</th>
                                                            <th class="">IP Address</th>
                                                            <th class="text-center">Action</th>
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


<script src="{{ URL::asset('admin_panel/controller_js/cn_enquiry.js')}}"></script>

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
    $(".s_meun").removeClass("active");
    // $(".enquiry_active").addClass("active");
    $(".enquiry_active").addClass("active");
    $(".clear_btn").on("click", function(){
        location.reload();
    });
</script>
{{-- <script>

$(".export").on("click", function(){

     var type= $("#request_type").val();

         $.ajax({
            type: "get",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { type: type},
            url: base_url + "/admin/enquiry-export/",
            success: function (response) {
              
            },
            error: function (data) {
                console.log("Error:", data);
            },
        });
});
</script> --}}





@endsection