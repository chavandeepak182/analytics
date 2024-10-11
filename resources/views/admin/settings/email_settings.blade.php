@extends('admin.layout.layout')
@section("content")
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="overflow:hidden">
   <section class="content">
      <section class="content-header" style="padding: 0px 0px 15px 0;">
         <h1> Email Settings </h1>
      </section>
      <form action="{{ route('email.settings.store') }}" id="email_settings_form" method="post">
         @csrf
         <div class="row">
            <div class="col-lg-6 col-md-12">
               <div class="box box-primary">
                  <div class="box-header with-border">
                     <h3 class="box-title">Email Settings</h3>
                  </div>
                  <div class="box-body">
                     <input type="hidden" name="id" id="id" value="{{!empty($email_settings->id) ? $email_settings->id : ''}}">
                     <div class=" form-group">
                        <label class="control-label">Mail Protocol</label>
                        <select name="mail_protocol" id="mail_protocol" class="form-control">
                        <option value="">Select Protocol</option>
                           <option value="smtp" {{(!empty($email_settings->mail_protocol) && ($email_settings->mail_protocol == 'smtp')) ? 'selected' : ''}}>SMTP</option>
                           <option value="sendmail" {{(!empty($email_settings->mail_protocol) && ($email_settings->mail_protocol == 'sendmail')) ? 'selected' : ''}}>SENDMAIL</option>
                        </select>
                        @if($errors->has('mail_protocol'))
                           <span class="text-danger"><b>* {{$errors->first('mail_protocol')}}</b></span>
                        @endif
                     </div>
                     <div class="form-group">
                        <label class="control-label">Mail Title</label>
                        <input type="text" class="form-control" name="mail_title" id="mail_title" placeholder="Mail Title" value="{{!empty($email_settings->mail_title) ? $email_settings->mail_title : ''}}">
                        @if($errors->has('mail_title'))
                           <span class="text-danger"><b>* {{$errors->first('mail_title')}}</b></span>
                        @endif
                     </div>
                     <div class="form-group">
                        <label class="control-label">Mail Host</label>
                        <input type="text" class="form-control" name="mail_host" id="mail_host" placeholder="Mail Host" value="{{!empty($email_settings->mail_host) ? $email_settings->mail_host : ''}}">
                        @if($errors->has('mail_host'))
                           <span class="text-danger"><b>* {{$errors->first('mail_host')}}</b></span>
                        @endif
                     </div>
                     <div class="form-group">
                        <label class="control-label">Mail Port</label>
                        <input type="text" class="form-control" name="mail_port" id="mail_port" placeholder="Mail Port" value="{{!empty($email_settings->mail_port) ? $email_settings->mail_port : ''}}">
                        @if($errors->has('mail_port'))
                           <span class="text-danger"><b>* {{$errors->first('mail_port')}}</b></span>
                        @endif
                     </div>
                     <div class="form-group">
                        <label class="control-label">Mail Encryption</label>
                        <input type="text" class="form-control" name="mail_encryption" id="mail_encryption" placeholder="Mail Encryption" value="{{!empty($email_settings->mail_encryption) ? $email_settings->mail_encryption : ''}}">
                        @if($errors->has('mail_encryption'))
                           <span class="text-danger"><b>* {{$errors->first('mail_encryption')}}</b></span>
                        @endif
                     </div>
                     <div class="form-group">
                        <label class="control-label">Mail Username</label>
                        <input type="text" class="form-control" name="mail_username" id="mail_username" placeholder="Mail Username" value="{{!empty($email_settings->mail_username) ? $email_settings->mail_username : ''}}">
                        @if($errors->has('mail_username'))
                           <span class="text-danger"><b>* {{$errors->first('mail_username')}}</b></span>
                        @endif
                     </div>
                     <div class="form-group">
                        <label class="control-label">Mail Password</label>
                        <input type="text" class="form-control" name="mail_password" id="mail_password" placeholder="Mail Password" value="{{!empty($email_settings->mail_password) ? $email_settings->mail_password : ''}}">
                        @if($errors->has('mail_password'))
                           <span class="text-danger"><b>* {{$errors->first('mail_password')}}</b></span>
                        @endif
                     </div>
                     <div class="callout" style="max-width: 500px;margin-top: 30px;">
                        <h4>Gmail SMTP</h4>
                        <p>To send e-mails with Gmail server, please read Email Settings section in our documentation.</p>
                     </div>
                  </div>
                  <div class="box-footer">
                     <button type="submit" name="email_settings" value="email" id="submit" class="btn btn-primary pull-right">Save Changes</button>
                  </div>
               </div>
            </div>
      
            <!-- <div class="col-lg-6 col-md-12">
               <div class="box box-primary">
                  <div class="box-header with-border">
                     <h3 class="box-title">Email Verification</h3>
                  </div>
                  <div class="box-body">
                     <div class="form-group">
                        <div class="row">
                           <div class="col-sm-12 col-xs-12">
                              <label>Email Verification</label>
                           </div>
                           <div class="col-sm-4 col-xs-12 col-option">
                           <input type="radio" id="enable" name="enable" value="1" onclick="checkbox(this.value)" {{!empty($email_settings->status) && $email_settings->status == 'active' ? 'checked' : ''}}>
                           <label class="option-label">Enable</label>
                           </div>
                           <div class="col-sm-4 col-xs-12 col-option">
                           <input type="radio" id="disable" name="disable" value="0" onclick="checkbox(this.value)" {{!empty($email_settings->status) && $email_settings->status == 'inactive' ? 'checked' : ''}}>
                           <label class="option-label">Disable</label>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="box-footer">
                     <button type="submit" name="email_verification" value="verification" class="btn btn-primary pull-right">Save Changes</button>
                  </div>
               </div>
            </div> -->
         </div>
      </form>
   </section>
</div>

@endsection
@section('script')
<script src="{{asset('admin_panel/controller_js/cn_email_settings.js')}}"></script>

<script type="text/javascript">
   $(".s_meun").removeClass("active");
   $(".settings_active").addClass("active");
   $(".email_settings_active").addClass("active");
</script>

<script>
    $('#mail_username').keyup(function(){
        this.value = this.value.toLowerCase();
    });
</script>
@endsection
