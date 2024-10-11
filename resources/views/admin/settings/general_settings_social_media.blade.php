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
                     <li class=""><a href="{{url('admin/general-settings-contact')}}">Contact Settings</a></li>
                     <li class="active"><a href="{{url('admin/general-settings-social-media')}}">Social Media Settings</a></li>
                  </ul>
                  <form action="{{route('geraral.settings.store')}}" method="post" id="general_settings_contact_form" enctype="multipart/form-data">
                      @csrf
                       <input type="hidden" name="id" value="{{!empty($general_settings->id)?$general_settings->id:''}}">
                  
                        <div class="tab-content settings-tab-content">
                            <!-- tab_2 start -->
                            <!-- tab_3 start -->
                            <div id="tab_3">
                                 <div class="form-group">
                                    <label class="control-label">Facebook URL<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="facebook_url" id="facebook_url" placeholder="Facebook URL" value="{{!empty($general_settings->facebook_url) ? $general_settings->facebook_url : ''}}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">LinkedIn URL<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="linkedin_url" id="linkedin_url" placeholder="LinkedIn URL" value="{{!empty($general_settings->linkedin_url) ? $general_settings->linkedin_url : ''}}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Instagram URL<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="instagram_url" id="instagram_url" placeholder="Instagram URL" value="{{!empty($general_settings->instagram_url) ? $general_settings->instagram_url : ''}}">
                                </div>
                                <div class="form-group">
                                    <label class="control-label">Twitter URL<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="twitter_url" id="twitter_url" placeholder="Twitter URL" value="{{!empty($general_settings->twitter_url) ? $general_settings->twitter_url : ''}}">
                                </div>
                                  <div class="form-group">
                                    <label class="control-label">Skype URL<span style="color: red;">*</span></label>
                                    <input type="text" class="form-control" name="skype_url" id="skype_url" placeholder="Twitter URL" value="{{!empty($general_settings->skype_url) ? $general_settings->skype_url : ''}}">
                                </div>
                            </div>
                        </div>
                        <!-- /.tab-content End -->
                        <div class="box-footer">
                            <button type="submit" name ="social_media_settings" id="submit_btn" class="btn btn-primary pull-right">Save Changes</button>
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
@endsection