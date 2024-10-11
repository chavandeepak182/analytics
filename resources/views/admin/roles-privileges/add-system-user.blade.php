@extends('admin.layout.layout')
@section("content")

<style>
     .content-wrapper {
        min-height: 0 !important;
    }
    .faq-toggle {
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .row.faq-color-div {
        margin: 0px 15px 15px;
        background: #2d296724;
        padding: 10px 0px;
        border: 1px solid #2d296726;
        box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;
        border-radius: 2px;
    }
</style>

<div class="content-wrapper">
    <!-- Main content -->
    <section class="content">
        <div class="row no-margin">
            <section class="content-header">
               <h1>
                  Add System User
                  <div class="pull-right">
                     <a href="{{url('admin/system-user-list')}}">
                        <button type="button" class="btn btn-danger"><i class="fa fa-arrow-circle-left"></i> Back</button>
                     </a>
                  </div>
               </h1>
            </section>
            

            <div class="box box-primary">
                <div class="box-body light-green-body" style="min-height: 375px;">
                    <form action="{{ route('system-user.store') }}" method="post" id="add-system-user-form" enctype="multipart/form-data">
                        @csrf
                        <div class="col-md-7">
                            <div class="row">
                                <input type="hidden" class="form-control" id="id" name="id" value="{{ !empty($system_user_details) ? $system_user_details->id : '' }}">
                                <div class="col-md-12 form-group">
                                    <label>Name <span class="text-danger"><b>*</b></span></label>
                                    <input type="text" class="form-control" id="name" name="name" value="{{ !empty($system_user_details) ? $system_user_details->user_name : old('name') }}">
                                    @if($errors->has('name'))
                                        <span class="text-danger"><b>* {{$errors->first('name')}}</b></span>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Email <span class="text-danger"><b>*</b></span></label>
                                    <input type="text" class="form-control" id="email" name="email" value="{{ !empty($system_user_details) ? $system_user_details->email : old('email') }}">
                                    <span class="text-danger d-none" id="email_existence_message"></span>
                                    @if($errors->has('email'))
                                        <span class="text-danger"><b>* {{$errors->first('email')}}</b></span>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Mobile </label>
                                    <input type="text" class="form-control" id="mobile_no" name="mobile_no" value="{{ !empty($system_user_details) ? $system_user_details->mobile_no : old('mobile_no') }}">
                                    @if($errors->has('mobile_no'))
                                        <span class="text-danger"><b>* {{$errors->first('mobile_no')}}</b></span>
                                    @endif
                                </div>
                                <div class="col-md-12 form-group">
                                    <label>Address </label>
                                    <input type="text" class="form-control" id="address" name="address" value="{{ !empty($system_user_details) ? $system_user_details->address : old('address') }}">
                                    @if($errors->has('address'))
                                        <span class="text-danger"><b>* {{$errors->first('address')}}</b></span>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="col-md-12 form-group">
                                <label>Role <span class="text-danger"><b>*</b></span></label>
                                <select class="form-control" id="role" name="role">
                                    <option value="">Select Role</option>
                                    @if(!empty($all_roles))
                                        @foreach($all_roles as $role)
                                            <option value="{{ $role->id }}" {{ !empty($system_user_details->role_id) && ($system_user_details->role_id == $role->id) ? 'selected' : '' }}>{{ $role->role_name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                                @if($errors->has('role'))
                                    <span class="text-danger"><b>* {{$errors->first('role')}}</b></span>
                                @endif
                            </div>
                            @if(empty($system_user_details->id))
                            <div class="col-md-12 form-group">
                                <label>Password <span class="text-danger"><b>*</b></span></label>
                                <input type="text" class="form-control" id="password" name="password">
                                @if($errors->has('password'))
                                    <span class="text-danger"><b>* {{$errors->first('password')}}</b></span>
                                @endif
                            </div>
                            @endif
                            <div class="col-md-12 form-group">
                                <label>Upload Images <small class="text-danger">( 768 * 400 , Only jpg,png &amp; jpeg format)</small><span style="color: red;">*</span></label>
                                <input type="file" class="form-control preview" id="image_path" name="image_path" accept=".jpg,.jpeg,.bmp,.png,">
                                <input type="hidden" name="old_profile_image" id="old_profile_image" value="{{!empty($system_user_details->image_path) ? $system_user_details->image_path : '';}}" class="form-control preview">
                                <div class="clearfix"></div>
                                <img src="{{!empty($system_user_details->user_profile_image_path) && Storage::exists($system_user_details->user_profile_image_path) ? url('/').Storage::url($system_user_details->user_profile_image_path) : URL::asset('admin_panel/commonarea/dist/img/default1.png') }}" class="img-select preview_image" alt="{{!empty($system_user_details->user_profile_image_name) ? $system_user_details->user_profile_image_name :'User Image';}}">
                                @if($errors->has('image_path'))
                                    <span class="text-danger"><b>* {{$errors->first('image_path')}}</b></span>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12 form-group">
                            <div class="buttons">
                                <button type="submit" name="save_btn" class="btn btn-success save_btn submit" data-id="submit" id="submit-btn"><i class="fa fa-check-circle"></i>{{ !empty($system_user_details) ? 'Update' : 'Add' }}</button>
                                <a href=""><button type="reset" class="btn btn-danger"><i class="fa fa-times-circle"></i> Clear</button></a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection
@section('script')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script>
    $("#category_id").select2({
        placeholder: "Select Category",
        allowClear: true
    });
</script>

<script type="text/javascript">
    $(document).ready(function() {
        $('input[type=checkbox]').click(function(){
            if($(this).val() == "active"){
                $(this).val('inactive');
                $(this).attr('checked','false');
            }else{
                $(this).val('active');
                $(this).attr('checked','true');
            }
        })
    });


    $(".s_meun").removeClass("active");
    $(".system_user_active").addClass("active");
    $(".user_list_active").addClass("active");
    $(".clear_btn").on("click", function() {
        location.reload();
    });
</script>
<script>
    $(document).ready(function() {
        $('.summernote').summernote({
            height: 200,
        }).on('summernote.keyup', function() {
            var text = $(".summernote").summernote("code").replace(/&nbsp;|<\/?[^>]+(>|$)/g, "").trim();
            if (text.length == 0) {
                $('#product_description-error').show();
            } else {
                $('#product_description-error').hide();
            }
        });
    });
</script>
<script>
   //  datepicker script
    $(document).ready(function() {

        $('#published_on').datepicker({
         format: 'dd/mm/yyyy',
         autoclose: true,
         todayHighlight: true,
         changeMonth: true,
         changeYear: true
        });

        $('#base_year').datepicker({
         format: 'yyyy',
         autoclose: true,
         todayHighlight: true,
         changeMonth: true,
         changeYear: true,
         viewMode: "years",
         minViewMode: "years"
        });

        $('#estimated_year').datepicker({
            format: 'yyyy',
            autoclose: true,
            todayHighlight: true,
            changeMonth: true,
            changeYear: true,
            viewMode: "years",
            minViewMode: "years"
        });

        $('#historical_data').datepicker({
            format: 'yyyy',
            autoclose: true,
            todayHighlight: true,
            changeMonth: true,
            changeYear: true,
            viewMode: "years",
            minViewMode: "years"
        });

        $('#forecast_period').datepicker({
         format: 'yyyy',
         autoclose: true,
         todayHighlight: true,
         changeMonth: true,
         changeYear: true,
         viewMode: "years",
         minViewMode: "years"
        });
   });

</script>

<script>
    $(document).ready(function(){
        $("#email").on("keyup", function(){
            $.ajax({
                type: "get",
                url: "{{ url('/admin/system-user/check-user-exist') }}",
                data: {
                    email: $(this).val(),
                    user_id: $("#id").val()
                },
                success: function(response){
                    console.log(response.trim());
                    if(response.trim() == "true"){
                        $("#submit-btn").attr("disabled", true);
                        $("#email_existence_message").removeClass("d-none");
                        $("#email_existence_message").html("<b>*</b> This Email has already been taken");
                    } else {
                        $("#email_existence_message").addClass("d-none");
                        $("#email_existence_message").html("");
                        $("#submit-btn").removeAttr("disabled");
                    }
                }
            })
        })
    })
</script>
@endsection

