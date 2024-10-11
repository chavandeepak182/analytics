@extends('admin.layout.layout')
@section('content')
<!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <section class="content">
    

     <!-- Main content -->


     <div class="row change-password-page-wrap">
         
       <div class="col-md-5 ">
       <section class="content-header " style="padding: 0px 0px 15px 0;">
       <!--<h1 class="text-center">-->
       <!--  Change Your Password-->
       <!--</h1>-->

     </section>
         <!-- general form elements -->
         <div class="box box-primary">

           <!-- /.box-header -->
           <!-- form start -->
           <form action="{{url('admin/change-password')}}" method="POST" id="change_password_form" role="form">
                <h3 class="change-password-title text-center">
                     Change Password
                </h3>
            @csrf
             <div class="box-body no-height">
                
               <div class="form-group old-password-main">
                 <label for="oldpass">Old Password<span style="color: red;">*</span></label>
                 <input type="password" class="form-control" id="old_password" name="old_password" value="">
                  <span class="pass-show"><i class="fa fa-eye"></i></span>
                 @if($errors->has('old_password'))
                    <div class="error text-danger change-old-pass-main"><strong>{{$errors->first('old_password')}}</strong></div>
                 @endif
               </div>
               <div class="form-group new-password-main">
                 <label for="newpass">New Passowrd<span style="color: red;">*</span></label>
                 <input type="password" class="form-control" id="new_password" name="new_password" value="">
                  <span class="pass-show"><i class="fa fa-eye"></i></span>
               </div>
               <div class="form-group  confirm-password-main">
                 <label for="cpassword">Confirm Password<span style="color: red;">*</span></label>
                 <input type="password" class="form-control" id="confirm_password" name="confirm_password" value="">
                  <span class="pass-show"><i class="fa fa-eye"></i></span>
               </div>
             </div>
             <!-- /.box-body -->

             <div class="box-footer text-center">
               <button type="submit" class="btn btn-primary submit">Update</button>
             </div>
           </form>
         </div>
         <!-- /.box -->
       </div>
     </div>
     <!-- /.row -->
   </section>

 </div>
 <!-- /.content-wrapper -->

 @endsection
 @section('script')
<script src="{{asset('admin_panel/controller_js/cn_change_password.js')}}"></script>
 <script>
     <!-- Password hide show -->

  $(".pass-show").on('click', function() {
    var passwordId = $(this).siblings();
    console.log("passwordId........", passwordId)
    if (passwordId.attr("type") === "password") {
      passwordId.attr("type", "text");
      $(this).find("i").removeClass("fa-eye")
      $(this).find("i").addClass("fa-eye-slash")
    } else {
      passwordId.attr("type", "password");
      $(this).find("i").addClass("fa-eye")
      $(this).find("i").removeClass("fa-eye-slash")
    }
  })

 </script>
 
 <script type="text/javascript">
    $(".s_meun").removeClass("active");
    $(".settings_active").addClass("active");
    $(".change_password_active").addClass("active");

   //  $("#example").dataTable();


    $('.clear_btn').on('click', function() {
        location.reload();
    });
</script>
 @endsection 