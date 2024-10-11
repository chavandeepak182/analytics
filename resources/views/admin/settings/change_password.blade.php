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
    table tbody tr td:nth-child(6){
        text-align: center;
    }
    .password-view-div {
        position: relative;
    }
    .password-view-div input{
        position: relative;
        z-index: 1;
    }
    .password-view-div i{
        position: absolute;
        top: 33px;
        right: 10px;
        z-index: 9999;
        cursor: pointer;
    }
</style>

<div class="content-wrapper" style="min-height: 1086px;">
    <!-- Main content -->
    <section class="content">
        <div class="row no-margin">
            <div class="col-md-4 no-pad">
                <section class="content-header">
                    <h1>Change Your Password</h1>
                </section>
                <div class="box box-primary">
                    <div class="box-body light-green-body">
                        
                        <form action="{{ url('/admin/change-password') }}" method="post" id="changePasswordForm">
                            @csrf
                            <!-- <input type="hidden" name="_token" value="">             -->
                            <div class="col-md-12 form-group no-padd ">
                                <div class="password-view-div">
                                    <label>Old Password<span style="color: red;">*</span></label>
                                    <input type="password" name="old_password" id="old_password" class="form-control" value="">
                                    <span class="pass-show-login"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                    @if($errors->has('old_password'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('old_password')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 form-group no-padd">
                                <div class="password-view-div">
                                    <label>New Password<span style="color: red;">*</span></label>
                                    <input type="password" name="new_password" id="new_password" class="form-control" value="">
                                    <span class="pass-show-login"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                    @if($errors->has('new_password'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('new_password')}}</span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12 form-group no-padd">
                                <div class="password-view-div">
                                    <label>Confirm New Password<span style="color: red;">*</span></label>
                                    <input type="password" name="confirm_password" id="confirm_password" class="form-control" value="">
                                    <span class="pass-show-login"><i class="fa fa-eye-slash" aria-hidden="true"></i></span>
                                    @if($errors->has('confirm_password'))
                                        <span class="text-danger"><b>*</b> {{$errors->first('confirm_password')}}</span>
                                    @endif
                                </div>
                            </div>
                            <!-- End form-group -->
                            <div class="clearfix"></div>
                            <div class="col-md-12 form-group no-padd">
                                <button type="submit" class="btn btn-success submit"><i class="fa fa-check-circle"></i> Update  </button>
                                <!-- <a href="javscript:(0);" class="btn btn-danger cancel-btn"><i class="fa fa-times-circle"></i> Cancel</a> -->
                            </div>
                        </form>
                <!-- End form-group -->
                    </div>
            <!-- End box-body -->
                </div>
        <!-- End box -->
            </div>
        </div>
        <!-- End box -->
    </section>
</div>

@endsection
@section('script')

<script>
    $(function() {
        $("#example").dataTable();
    });
</script>

<script type="text/javascript">
    $(".s_meun").removeClass("active");
    $(".settings_active").addClass("active");
    $(".change_password_active").addClass("active");
    $(".clear_btn").on("click", function() {
        location.reload();
    });
</script>

<script>
  $(".pass-show-login").on("click", function() {
    var passwordId = $(this).siblings();
    if (passwordId.attr("type") === "password") {
      passwordId.attr("type", "text");
      $(this).find("i").addClass("fa-eye");
      $(this).find("i").removeClass("fa-eye-slash");
    } else {
      passwordId.attr("type", "password");
      $(this).find("i").removeClass("fa-eye");
      $(this).find("i").addClass("fa-eye-slash");
    }
  });
</script>
@endsection

