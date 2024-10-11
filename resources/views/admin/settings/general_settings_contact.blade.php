<!-- Content Wrapper. Contains page content -->
@extends('admin.layout.layout')
@section("content")
<div class="content-wrapper">
   <!-- Main content -->
   <section class="content">
      <!-- Content Header (Page header) -->
      <section class="content-header pb_10px" style="padding: 0px 0px 15px 0;">
         <h1>
         General Settings
         </h1>
      </section>
      <!-- /.row start -->
      <div class="row">
         <!-- col-start -->
         <div class="col-md-12">
            <!-- form start -->
            {{-- <?php
               $attribute = array('role' => 'form', 'id' => 'settings_form');
               echo form_open('settings/settings-action', $attribute);
            ?> --}}
               <!-- Custom Tabs Start-->
               <div class="nav-tabs-custom">
                  <ul class="nav nav-tabs setting_ul_mobi">
                     <li class="active"><a href="{{url('admin/general-settings-contact')}}">Contact Settings</a></li>
                     <li class=""><a href="{{url('admin/general-settings-social-media')}}">Social Media Settings</a></li>
                  </ul>
                  <form action="{{route('geraral.settings.store')}}" method="post" id="general_settings_contact_form" enctype="multipart/form-data">
                     @csrf
                       <input type="hidden" name="id" value="{{!empty($general_settings->id)?$general_settings->id:''}}">
                     <div class="tab-content settings-tab-content">
                        <!-- tab_2 start -->
                        <div id="tab_2">
                           <div class="form-group">
                              <label class="control-label">Email Address<span style="color: red;">*</span></label>
                              <input type="text" class="form-control" name="email" id="email" placeholder="Email Address" value="{{!empty($general_settings->email) ? $general_settings->email : ''}}" style="text-transform:lowercase">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Mobile No.<span style="color: red;">*</span></label>
                              <input type="text" class="form-control" name="mobile" id="mobile" placeholder="Mobile Number" value="{{!empty($general_settings->mobile) ? $general_settings->mobile : ''}}">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Address<span style="color: red;">*</span></label>
                              <input type="text" class="form-control" name="address" id="address" placeholder="Address" value="{{!empty($general_settings->address) ? $general_settings->address : ''}}">
                           </div>
                           <div class="form-group">
                              <label class="control-label">Map Url<span style="color: red;">*</span></label>
                              <input type="text" class="form-control" name="map_url" id="map_url" placeholder="Address" value="{{!empty($general_settings->map_link) ? $general_settings->map_link: ''}}">
                           </div>
                        </div>
                     </div>
                     <!-- /.tab-content End -->
                     <div class="box-footer">
                        <button type="submit" name ="contact_settings" id="submit_btn" class="btn btn-primary pull-right">Save Changes</button>
                     </div>
                  </form>
               </div>
               <!-- Custom Tabs End-->
            <!-- form end --> 
         </div>
         <!-- col-end -->
      </div>
      <!-- /.row end -->
   </section>
   <!-- /.content -->
</div>
@endsection
@section('script')

<script src="{{asset('admin_panel/controller_js/cn_general_settings.js')}}"></script>

<!-- /.content-wrapper -->
<script type="text/javascript">
   //active sidebar menu start
     $(".s_meun").removeClass("active");
     $(".settings_active").addClass("active");
     $(".general_settings_active").addClass("active");
   //active sidebar menu end
</script>

<script>
    $('#contact_email').keyup(function(){
        this.value = this.value.toLowerCase();
    });
</script>
@endsection