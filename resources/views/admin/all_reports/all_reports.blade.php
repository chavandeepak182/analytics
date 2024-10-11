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
    table tbody tr td:nth-child(9),
    table tbody tr td:nth-child(10){
        text-align: center;
    }
    .modal-import .modal-body{
        padding: 10px;
    }
    .modal-import .modal-dialog{
        margin: 125px auto;
    }
    .modal-import .modal-body .modal-title{
        color: #dd4b39;
        font-size: 25px;
        font-weight: 600;
    }
    .modal-import .modal-content{
        border-radius: 10px;
    }
    .modal-import.in{
        padding-right: 0;
    }
    .modal-import .filter-btn{
        width: 25%;
        padding: 5px 0;
    }
    .modal-import .modal-body button.close{
        opacity: 1 !important;
        right: -12px !important;
        top: -11px !important;
        color: #fff;
    }
    .modal-import .modal-body button.close span{
        font-size: 17px;
        background: #000;
        padding: 1px 7px;
        border-radius: 100%;
    }
    .import-content{
        display: flex;
        flex-direction: column;
        gap: 20px;
        align-items: center;
        border: 1px solid #d9d9d9;
        padding: 15px;
        border-radius: 10px;
    }
    .scrollable-cell {
        max-height: 100px; /* Adjust the max height as needed */
        overflow: auto;
        white-space: pre-line; /* Preserve line breaks */
    }
    .btn-danger{
        margin-left: 5px;
    }
    .btn-warning{
        margin-left: 0px;
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
            <form action="{{ url('/admin/report/export') }}" method="post" enctype="multipart/form-data" id="filter-form" >
            @csrf
            <section class="content-header">
               <h1>All Reports
                    <div class="pull-right">
                        <span style="margin-right: 20px;">Total Reports - <span id="total_report_count" style="color: #ff0000;font-weight: 700;">{{ $totalReportCount }}</span></span>
                        <span style="margin-right: 20px;">Top Selling Reports- <span id="top_selling_report_count" style="color: #ff0000;font-weight: 700;">{{ $totalTopSellingReportCount }}</span></span>
                        <span style="margin-right: 20px;">Upoming Reports - <span id="total_upcoming_report_count" style="color: #ff0000;font-weight: 700;">{{ $totaUpcomingReportCount }}</span></span>
                        @if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_other'))
                        <button type="submit" style="background-color: #008d4c !important;" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i> Export Reports</button>
                        <button class="btn btn-primary" data-toggle="modal" data-target="#ImportReport">Import Report</button>
                        <a type="button" href="{{ url('/admin/report/sample-report') }}">
                            <button type="button" style="background-color: #008d4p !important;" class="btn btn-success"><i class="fa fa-file-excel-o" aria-hidden="true"></i>Sample Report</button>
                        </a> 
                        @endif
                        @if (!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'report_add'))
                        <a href="{{ url('admin/report/create') }}">
                            <button type="button" class="btn btn-primary"><i class="fa fa-plus-circle"></i>
                                Add Reports
                            </button>
                        </a>
                        @endif
                    </div>
               </h1>
            </section>
            <div class="col-md-12 no-pad" style="display: block;">
                <div class="box box-primary" style="background: #fff;">
                    <div class="box-body no-height">
                        <div class="row">
                                <div class="col-md-3 form-group no-pad-right">
                                    <label>From Date<span style="color: red;">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar date"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right date" id="fromdate" name="fromdate" autocomplete="off" value="">
                                    </div>
                                </div>
                                <div class="col-md-3 form-group">
                                    <label>To Date<span style="color: red;">*</span></label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar date"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right date" id="todate" name="todate" autocomplete="off" value="">
                                    </div>
                                </div>
                                
                                <div class="col-sm-5 form-group no-pad-left mob-no-pad">
                                    <label>Category</label>
                                    <select class="form-control w-100" id="category_id" name="category_id">
                                        @if(!empty($categories))
                                            <option value="">All</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ isset($report) && ($report->category_id == $category->id) ? 'selected' : '' ; }}> {{ $category->category_name }} </option>
                                            @endforeach
                                        @else
                                            <option value="">Select</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="col-sm-1 form-group mt-26 no-pad-left mob-no-pad">
                                    <button type="button" name="filter" class="btn btn-primary filter-btn w-100"> Clear</button>
                                </div>
                                
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <section class="content" style="padding:5px 0px;">
                <div class="col-md-12 no-padd">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="row no-margin">
                                <div class="col-sm-12">
                                    <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 no-padd" style="overflow-x: auto;" class="table_parent_div">
                                                <table id="arm_data_table" class="table table-bordered dataTable no-footer">
                                                    <thead>
                                                        <tr role="row">
                                                            <th width="20%" class="text-center">Sr. No.</th>
                                                            <th width="20%" class="text-center">Report Id</th>
                                                            <th width="20%" class="text-center">Upcoming Report</th>
                                                            <th width="20%" class="">Top Selling Reports</th>
                                                            <th width="20%" class="">Report Title</th>
                                                            <th width="20%" class="">Category</th>
                                                            <th width="20%" class="">Publisher</th>
                                                            <th width="20%" class="">Report URL</th>
                                                            <th width="20%" class="text-center">Published On</th>
                                                            <th width="20%" class="text-center">Related Reports</th>
                                                            <th width="20%" class="text-center">Status</th>
                                                            <th width="20%" class="text-center">Action</th>
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


<!-- The modal -->
<div class="modal fade modal-import" id="ImportReport" tabindex="-1" role="dialog" aria-labelledby="modalLabelSmall" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

            <div class="modal-body">
                <div class="import-content">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">X</span>
                    </button>
                    <h4 class="modal-title">Upload Report from Excel File</h4>
                    <form action="{{ url('admin/report/import') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="file" class="form-control" id="import_report" name="import_report" accept=".xlsx, .xls, .csv">
                        @if($errors->has('import_report'))
                            <span class="text-danger"><b>*</b> {{$errors->first('import_report')}}</span>
                        @endif
                        <button type="submit" class="btn btn-primary filter-btn">Import</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')

<script src="{{ URL::asset('admin_panel/controller_js/cn_reports.js')}}"></script>

<script type="text/javascript">
     $(document).ready(function() {
        $('#example').DataTable();
    });
    $(".s_meun").removeClass("active");
    $(".all_reports_active").addClass("active");
    $(".clear_btn").on("click", function() {
        location.reload();
    });
</script>

<script>
   //  datepicker script
   $(document).ready(function() {

      $('#fromdate').datepicker({
         format: 'dd-mm-yyyy',
         autoclose: true,
         todayHighlight: true,
         changeMonth: true,
         changeYear: true
      });

      $('#todate').datepicker({
         format: 'dd-mm-yyyy',
         autoclose: true,
         todayHighlight: true,
         changeMonth: true,
         changeYear: true
      });
   });
</script>

@endsection

