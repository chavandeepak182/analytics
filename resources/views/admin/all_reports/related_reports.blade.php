@extends('admin.layout.layout')
@section("content")
<style>
    
    .select2-container--default .select2-selection--single .select2-selection__rendered {
        line-height: 22px;
    }

    .select2-container .select2-selection--single .select2-selection__rendered {
        padding-left: 0px;
    }

    .scrollable-cell {
        max-height: 100px; /* Adjust the max height as needed */
        overflow: auto;
        white-space: pre-line; /* Preserve line breaks */
    }
    .report-title-div {
        color: #1a1744;
        font-weight: 700;
        font-size: 15px;
        background: aliceblue;
        padding: 10px;
        /* border: 1px solid #f1f1f1; */
        box-shadow: rgba(17, 17, 26, 0.1) 0px 1px 0px;
        /* box-shadow: rgba(50, 50, 105, 0.15) 0px 2px 5px 0px, rgba(0, 0, 0, 0.05) 0px 1px 1px 0px; */
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
               <h1>Add Related Reports
                    <div class="pull-right">
                        <a href="{{url('admin/report')}}">
                            <button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</button>
                        </a>
                    </div>
               </h1>
            </section>
            <div class="col-md-12 no-pad" style="display: block;">
                <div class="box box-primary" style="background: #fff;">
                    <div class="box-body no-height">
                        <div class="row">
                            <form action="{{ route('report.related_report.store') }}" method="post" enctype="multipart/form-data" id="related-report-form" >
                                @csrf
                                <input type="hidden" name="report_id" value="{{ isset($report_id) && !empty($report_id) ? $report_id : '' }}">
                                
                                <div class="col-sm-12 form-group mob-no-pad">
                                    <div class="report-title-div">
                                        <a href="{{ url('/reports/'.$report_details->url.'/'.$report_details->id) }}" target="blank">{{ !empty($report_details->title) ? $report_details->title : '' }}</a>
                                    </div>
                                </div>
                                
                                <div class="col-sm-3 form-group mob-no-pad">
                                    <label>Category</label>
                                    <select class="form-control w-100" id="category_id" name="category_id">
                                        @if(!empty($categories))
                                            <option value="">All</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}"> {{ $category->category_name }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('category_id'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('category_id')}}</span>
                                    @endif
                                </div>

                                <div class="col-sm-7 form-group mob-no-pad">
                                    <label>Related Reports</label>
                                    <select class="form-control w-100" id="related_report_id" name="related_report_id">
                                        @if(!empty($reports))
                                            <option value="">All</option>
                                            @foreach($reports as $report)
                                                <option value="{{ $report->id }}"> {{ $report->title }} </option>
                                            @endforeach
                                        @endif
                                    </select>
                                    @if($errors->has('related_report_id'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('related_report_id')}}</span>
                                    @endif
                                </div>

                                <div class="col-sm-2 form-group mt-26 no-pad-left mob-no-pad">
                                    <button type="submit" name="filter" class="btn btn-primary filter-btn w-100" {{ !empty($RolesPrivileges) && str_contains($RolesPrivileges, 'related_report_add') ? '' : 'disabled' }}> Add </button>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
                                                            <th width="7%" class="text-center">Sr. No.</th>
                                                            <th width="40%" class="">Related Report Title</th>
                                                            <th width="20%" class="">Category</th>
                                                            <th width="20%" class="">Report URL</th>
                                                            <th width="7%" class="text-center">Status</th>
                                                            <th width="6%" class="text-center">Action</th>
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
<script src="{{ URL::asset('admin_panel/controller_js/cn_related_report.js')}}"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(".s_meun").removeClass("active");
    $(".all_reports_active").addClass("active");
</script>
<script>
    $("#related_report_id").select2({
        placeholder: "Select Report",
        allowClear: true
    });
    $("#category_id").select2({
        placeholder: "Select Report",
        allowClear: true
    });
</script>
<script>
    $(document).ready(function(){
        $("#category_id").change(function(){
            $.ajax({
                type: "GET",
                url: "{{ route('get_reports_under_category') }}",
                data: { 
                    category_id: $(this).val()
                },
                success: function(response){
                    if(response.length > 0){
                        $("#related_report_id").html('');
                        $("#related_report_id").append('<option value="">All</option>');
                        for(var i=0; i<response.length; i++){
                            $("#related_report_id").append('<option value="'+response[i]['id']+'">'+response[i]['title']+'</option>')
                        }
                    }
                }
            })
        })
    })
</script>
@endsection