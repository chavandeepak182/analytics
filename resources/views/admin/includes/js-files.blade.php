<!-- ./wrapper -->

<!-- jQuery 3 -->


<!-- jQuery UI 1.11.4 -->
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ URL::asset('admin_panel/commonarea/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
<!-- Morris.js charts -->
<script src="{{ URL::asset('admin_panel/commonarea/bower_components/raphael/raphael.min.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/bower_components/morris.js/morris.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{ URL::asset('admin_panel/commonarea/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{ URL::asset('admin_panel/commonarea/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ URL::asset('admin_panel/commonarea/bower_components/jquery-knob/dist/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{ URL::asset('admin_panel/commonarea/bower_components/moment/min/moment.min.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/bower_components/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
<!-- datepicker -->
<script src="{{ URL::asset('admin_panel/commonarea/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- timepicker -->
<script src="{{ URL::asset('admin_panel/commonarea/plugins/timepicker/bootstrap-timepicker.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/plugins/timepicker/bootstrap-timepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ URL::asset('admin_panel/commonarea/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<!-- Slimscroll -->
<script src="{{ URL::asset('admin_panel/commonarea/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<!-- FastClick -->
<script src="{{ URL::asset('admin_panel/commonarea/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->

<!-- AdminLTE for summernote -->

<script src="{{URL::asset('admin_panel/commonarea/plugins/summernote/summernote0226.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/plugins/summernote/summernote.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/dist/js/adminlte.min.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/dist/js/adminlte.min.js')}}"></script>

<!-- AdminLTE dashboard demo (This is only for demo purposes) -->

<!-- AdminLTE for demo purposes -->
<script src="{{ URL::asset('admin_panel/commonarea/dist/js/demo.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/plugins/iCheck/icheck.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/plugins/iCheck/icheck.min.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/plugins/file-manager/js/file-manager-panel.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/plugins/file-manager/js/jquery.dm-uploader.min.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/plugins/file-manager/js/ui.js')}}"></script>



<!-- select2.min start -->
<!-- <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script> -->
<script src="{{ URL::asset('admin_panel/commonarea/dist/js/fSelect.js')}}"></script>

<script src="{{ URL::asset('admin_panel/js/sweetalert.min.js')}}"></script>
<script src="{{ URL::asset('admin_panel/js/js_common_validations.js')}}"></script>
<!-- fselect -->
<script src="{{ URL::asset('admin_panel/js/validations/common/common.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/plugins/dataTables/jszip.min.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/plugins/dataTables/jquery.dataTables.min.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/plugins/dataTables/dataTables.buttons.min.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/plugins/dataTables/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/plugins/dataTables/buttons.html5.min.js')}}"></script>
<script src="{{ URL::asset('admin_panel/commonarea/plugins/dataTables/dataTables.fixedHeader.min.js')}}"></script>
<script src="{{ URL::asset('admin_panel/js/jquery.validate.js')}}"></script>
<script src="{{ URL::asset('admin_panel/js/jquery.toast.min.js')}}"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/jquery.validation/1.16.0/additional-methods.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

<!-- Swiper JS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@9/swiper-bundle.min.js"></script>
<!-- Swiper JS -->

<script>
  function loadFunction() {
    $('#preloader').hide();
  }

  $('.clear_btn').on('click', function() {
    location.reload();
  });
  $('.sidebar-toggle').on('click', function() {
    $('body').toggleClass('sidebar-collapse')
  })
</script>

<script>
  @if(Session::has('success'))
  toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
  }
  toastr.success("{{ session('success') }}");
  @endif

  @if(Session::has('error'))
  toastr.options = {
    "closeButton": true,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
  }
  toastr.error("{{ session('error') }}");
  @endif
</script>

<script>
  var imageVal = $(".valid").change(function() {
    var $input = $(this);
    var files = $input[0].files;
    var filename = files[0].name;
    var extension = filename.substr(filename.lastIndexOf("."));
    var allowedExtensionsRegx = /(\.jpg|\.jpeg|\.png)$/i;
    var isAllowed = allowedExtensionsRegx.test(extension);
    if (!isAllowed) {
      //   alert("File type is valid for the upload");
      alert("Invalid File Type.");
    } else {
      return false;
    }
  });
</script>

<script>
  function success_toast(title = '', message = '') {
    $.toast({
      heading: title,
      text: message,
      icon: 'success',
      loader: true, // Change it to false to disable loader
      loaderBg: '#9EC600', // To change the background,
      position: "bottom-right"
    });
  }

  function fail_toast(title = '', message = '') {
    $.toast({
      heading: title,
      text: message,
      icon: 'error',
      loader: true, // Change it to false to disable loader
      loaderBg: '#9EC600', // To change the background,
      position: "bottom-right"
    });
  }
</script>