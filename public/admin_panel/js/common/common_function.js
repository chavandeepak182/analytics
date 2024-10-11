
//     $(function (){
//         var table = $('#example').DataTable({
//             processing: true,
//             serverSide: true,
//             ajax: "{{url('blog')}}",
//             columns: [
//                 {data: 'DT_RowIndex', name: 'DT_RowIndex'},
//                 {data: 'blog_name', name: 'blog_name'},
//                 {data: 'blog_date', name: 'blog_date'},
//                 {data: 'blog_by', name: 'blog_by'},
//                 {data: 'status', name: 'status', orderable: false, searchable: false},
//                 {data: 'action', name: 'action', orderable: false, searchable: false},
//             ]       
//         });
//         function reload_table() {
//             table.DataTable().ajax.reload(null, false);
//         }
//     })

//     $("#submit").click(function(e){  
//         e.preventDefault();
//         var title = $("#title").val();
//         var name = $("#name").val();
//         var description = $("#description").val();
//         var customer_id = $('#customer_id').val();
//         $.ajax({
//             type:'POST',
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             url:"{{ url('new-customer') }}",
//             data:{title:title, name:name, description:description,customer_id:customer_id},
//             success:function(response){
//                 console.log(response);
//                 if(response) {
//                     $('.success').text(response.success);
//                     $("#form")[0].reset();
//                     var oTable = $('#example').dataTable();
//                     oTable.fnDraw(false);
//                 }
//             }
//         });
//     });

// $(document).on('click', '.deleteCustomer', function () {
//     var customer_id = $(this).data('customer_id');
//     var actionDiv = $(this);

//     if(confirm('Do you really want to delete this record ?')){
//         $.ajax({
//             type: "post",
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             data: {'customer_id' : customer_id},
//             url: "{{ url('customer-delete') }}",
//             beforeSend: function () {
//                 actionDiv.html("<i class='fa fa-spin fa-spinner' style='color: #000000 !important;'></i>").show();
//             },
//             success: function (data) { 
//                 var oTable = $('#example').dataTable();
//                 oTable.fnDraw(false);
//             },
//             error: function (data) {
//                 console.log('Error:', data);
//             }
//         });
//     }
// });

// $(document).on('click', '.StatusChange', function(){
//     var customer_id = $(this).data('customer_id');
//     var actionDiv = $(this);
//     if(confirm('If you really want to change status ?')){
//         $.ajax({
//             type: "post",
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             data: {'customer_id' : customer_id},
//             url: "{{ url('customer-status') }}",
           
//             beforeSend: function () {
//                 actionDiv.html("<i class='fa fa-spin fa-spinner' style='color: #0c0c0c !important;'></i>").show();
//             },
//             success: function (data) { 
//                 var oTable = $('#example').dataTable();
//                 oTable.fnDraw(false);
//             },
//             complete: function () {
//                 actionDiv.hide();
//             },
//         });
//     }
// });




// $(document).on('click', '.Edit_button', function(){
//     var customer_id = $(this).data('customer_id');
//     var actionDiv = $(this);
//     // alert(customer_id);
//     if(confirm('If you really want to update record ?')){
//         $.ajax({
//             type: "get",
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
//             data: {'customer_id' : customer_id},
//             url: "{{ url('customer-edit') }}",
//             success: function (data) { 
//                 // alert(data);
//                 $('#title').val(data.title);
//                 $('#name').val(data.name);
//                 $('#description').val(data.description);
//                 $('#customer_id').val(data.id);
//             },
//         });
//     }
// });

// $(document).ready(function(){
//     $('.clear').click(function(){
//         $("#title").val('');
//         $("#name").val('');
//         $("#description").val('');
//         $('#success_message').hide();
//     });
// });


$(function () {
  $(document).on("click", ".change-status", function () {
      // alert(); return false;
      if (confirm("Do you really want to change status?")) {
        var actionDiv = $(this);
        var id = actionDiv.attr("data-id");
        var flash = actionDiv.attr("flash");
        var table = actionDiv.attr("table");
        let status = actionDiv.attr("status").trim() === "1" ? "2" : "1";
  
        $.ajax({
          url: base_url + "/admin/change-status",
          type: "POST",
          dataType: "json",
          data: {
            pk_id: id,
            table: table,
            flashdata_message: flash,
            status: status,
          },
          beforeSend: function () {
            actionDiv.html(
              "<i class='fa fa-spin fa-spinner' style='color: #0c0c0c !important;'></i>"
            );
          },
          success: function (data) {
            if (data.status == true) {
              actionDiv.attr("status", status);
              success_toast("Success", data.message);
              setTimeout(function () {
                if (status == "1") {
                  actionDiv.html(
                    "<i class='fa fa-toggle-on tgle-on' aria-hidden='true' title='Active'></i>"
                  );
                } else {
                  actionDiv.html(
                    "<i class='fa fa-toggle-on tgle-off fa-rotate-180' aria-hidden='true' title='In-Active'></i>"
                  );
                }
              }, 1000);
            } 
            else 
            {
              fail_toast("error", data.message);
              setTimeout(function () 
              {
                actionDiv.html(
                  "<i class='fa fa-toggle-on tgle-off fa-rotate-180' aria-hidden='true' title='In-Active'></i>"
                );
              }, 1000);
            }
          },
        });
      }
    });
  });








