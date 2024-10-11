@extends('admin.layout.layout')
@section("content")

<style>
    .content-wrapper {
        min-height: 0 !important;
    }

    table tbody tr td:nth-child(1),
    table tbody tr td:nth-child(3),
    table tbody tr td:nth-child(4),
    table tbody tr td:nth-child(5) {
        text-align: center;
    }
</style>

@php
    $role_id = Auth::guard('arm_admins')->user()->role_id;
    $RolesPrivileges = App\Models\Arm_role_privilege::where('id', $role_id)->where('status', 'active')->select('privileges')->first();
@endphp

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row no-margin">
            <section class="content-header">
                <h1>Page Content</h1>
            </section>
            <section class="content" style="padding: 0px;">
                <div class="col-md-12 no-padd">
                    <div class="box box-primary">
                        <div class="box-body">
                            <div class="row no-margin">
                                <div class="col-sm-12">
                                    <div id="example_wrapper" class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                                        <div class="row">
                                            <div class="col-sm-12 no-padd">
                                                <table id="example" class="table table-bordered dataTable no-footer">
                                                    <thead>
                                                        <tr role="row">
                                                            <th width="15%" class="text-center">Sr. No.</th>
                                                            <th width="70%" class="">Page Name</th>
                                                            <th width="15%" class="text-center">Action</th> 
                                                        </tr>
                                                    </thead>
                                                    <tbody> 
                                                        @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'cms_view') && str_contains($RolesPrivileges, 'page_content_view') && str_contains($RolesPrivileges, 'home_page_view'))
                                                        <tr>
                                                            <td>1</td>
                                                            <td>Homepage</td>
                                                            <td>
                                                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'home_page_edit'))
                                                                <a href="{{url('admin/homepage')}}" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                                                            @else
                                                                <a href="" class="btn btn-warning btn-xs" title="disabled" disabled><i class="fa fa-pencil"></i></a>
                                                            @endif
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'cms_view') && str_contains($RolesPrivileges, 'page_content_view') && str_contains($RolesPrivileges, 'about_us_view'))
                                                        <tr>
                                                            <td>2</td>
                                                            <td>About Us</td>
                                                            <td>
                                                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'about_us_edit'))
                                                                <a href="{{url('admin/about-us')}}" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                                                            @else
                                                                <a href="" class="btn btn-warning btn-xs" title="disabled" disabled><i class="fa fa-pencil"></i></a>
                                                            @endif
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'cms_view') && str_contains($RolesPrivileges, 'page_content_view') && str_contains($RolesPrivileges, 'service_consulting_view'))
                                                        <tr>
                                                            <td>3</td>
                                                            <td>Services - Consulting</td>
                                                            <td>
                                                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'service_consulting_edit'))
                                                                <a href="{{url('admin/services-consulting')}}" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                                                            @else
                                                                <a href="" class="btn btn-warning btn-xs" title="disabled" disabled><i class="fa fa-pencil"></i></a>
                                                            @endif
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'cms_view') && str_contains($RolesPrivileges, 'page_content_view') && str_contains($RolesPrivileges, 'service_subscription_view'))
                                                        <tr>
                                                            <td>4</td>
                                                            <td>Services - Subscription</td>
                                                            <td>
                                                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'service_subscription_edit'))
                                                                <a href="{{url('admin/services-subscription')}}" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                                                            @else
                                                                <a href="" class="btn btn-warning btn-xs" title="disabled" disabled><i class="fa fa-pencil"></i></a>
                                                            @endif
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'cms_view') && str_contains($RolesPrivileges, 'page_content_view') && str_contains($RolesPrivileges, 'custom_research_service_view'))
                                                        <tr>
                                                            <td>5</td>
                                                            <td>Services - Custom Research Service</td>
                                                            <td>
                                                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'custom_research_service_edit'))
                                                                <a href="{{url('admin/services-custom-market-research')}}" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                                                            @else
                                                                <a href="" class="btn btn-warning btn-xs" title="disabled" disabled><i class="fa fa-pencil"></i></a>
                                                            @endif
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'cms_view') && str_contains($RolesPrivileges, 'page_content_view') && str_contains($RolesPrivileges, 'we_market_client_support_view'))
                                                        <tr>
                                                            <td>6</td>
                                                            <td>Services - We Market Client Support</td>
                                                            <td>
                                                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'we_market_client_support_edit'))
                                                                <a href="{{url('admin/services-we-market-client-support')}}" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                                                            @else
                                                                <a href="" class="btn btn-warning btn-xs" title="disabled" disabled><i class="fa fa-pencil"></i></a>
                                                            @endif
                                                            </td>
                                                        </tr>
                                                        @endif
                                                        @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'cms_view') && str_contains($RolesPrivileges, 'page_content_view') && str_contains($RolesPrivileges, 'research_methodology_view'))
                                                        <tr>
                                                            <td>7</td>
                                                            <td>Research Methodology</td>
                                                            <td>
                                                            @if(!empty($RolesPrivileges) && str_contains($RolesPrivileges, 'research_methodology_edit'))
                                                                <a href="{{url('admin/research-methodology')}}" class="btn btn-warning btn-xs" title="Edit"><i class="fa fa-pencil"></i></a>
                                                            @else
                                                                <a href="" class="btn btn-warning btn-xs" title="disabled" disabled><i class="fa fa-pencil"></i></a>
                                                            @endif
                                                            </td>
                                                        </tr>
                                                        @endif
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


<!-- <script src="{{ URL::asset('admin_panel/controller_js/cn_category.js')}}"></script> -->

<script type="text/javascript">
    $(document).ready(function() {
        $('#example').DataTable();
    });
    $(".s_meun").removeClass("active");
    $(".cms_menu_active").addClass("active");
    $(".page_content_active").addClass("active");
    $(".clear_btn").on("click", function() {
        location.reload();
    });
</script>

@endsection