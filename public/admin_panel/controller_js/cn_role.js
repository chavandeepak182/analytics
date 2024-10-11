// Client Side form validation
$(document).ready(function () {
    $("#roles_and_privileges_form").validate({
        rules: {
            role_name: {
                required: true,
                remote: {
                    url: base_url + "/admin/role-exists",
                    headers: {
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                    type: "post",
                    data: {
                        txtpkey: function () {
                            return $("#txtpkey").val();
                        },
                        role_name: function () {
                            return $("#role_name").val();
                        }
                    },
                },
            },
            "privileges[]": {
                required : true,
            }
        },
        messages: {
            role_name: {
                required: "*Enter role name",
                remote: "* This role already exists.",
            },
            "privileges[]": {
                required: "*Select privileges",
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});

// datatable data

$(function () {
    var table = $('#roles_and_privileges_table').DataTable({
        processing: true,
        serverSide: true,

        ajax: base_url + "/admin/roles-and-privileges-data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'role_name',
            name: 'role_name'
        },
        {
            data: 'status',
            name: 'status',
            orderable: false,
            searchable: false
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
        ]
    });

    function reload_table() {
        table.DataTable().ajax.reload(null, false);
    }
})

function deleteRole(role_id)
{
    var id = role_id;
    var actionDiv = $(this);
    if (confirm("Do you really want to delete this role ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id},
            url: base_url + "/admin/delete-role",
            beforeSend: function () 
            {
                $(this).hide();
                actionDiv
                    .html(
                        "<i class='fa fa-spin fa-spinner' style='color: #0c0c0c !important;'></i>"
                    )
                    .show();
            },
            success: function (data) {

                if(data.status == 'true'){
                    var oTable = $("#roles_and_privileges_table").dataTable();
                    success_toast("Success", data.message);
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#roles_and_privileges_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
}


function RoleStatusChange(role_id)
{
    var id = role_id;
    var actionDiv = $(this);
    if (confirm("Do you really want to change status ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id},
            url: base_url + "/admin/change-role-status",
            beforeSend: function () 
            {
                $(this).hide();
                actionDiv
                    .html(
                        "<i class='fa fa-spin fa-spinner' style='color: #0c0c0c !important;'></i>"
                    )
                    .show();
            },
            success: function (data) {

                if(data.status == 'true'){
                    var oTable = $("#roles_and_privileges_table").dataTable();
                    success_toast("Success", data.message);
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#roles_and_privileges_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
}



// all view select
$('.all-view').on('change', function(){
    if($('.all-view').is(":checked")){
        $('.view').each(function(){
            $(this).prop('checked',true);
        });
    }else{
        $('.view').each(function(){
            $(this).prop('checked',false);
        });
    }
})

$('.view').on('change', function(){
    $('.view').each(function(){
        if($(this).is(":checked")){
            $('.all-view').prop('checked',true);
        }else{
            $('.all-view').prop('checked',false);
            return false;
        }
    })
})

// all add select
$('.all-add').on('change', function(){
    if($('.all-add').is(":checked")){
        $('.add').each(function(){
            $(this).prop('checked',true);
        });
    }else{
        $('.add').each(function(){
            $(this).prop('checked',false);
        });
    }
})

$('.add').on('change', function(){
    $('.add').each(function(){
        if($(this).is(":checked")){
            $('.all-add').prop('checked',true);
        }else{
            $('.all-add').prop('checked',false);
            return false;
        }
    })
})

// all edit select
$('.all-edit').on('change', function(){
    if($('.all-edit').is(":checked")){
        $('.edit').each(function(){
            $(this).prop('checked',true);
        });
    }else{
        $('.edit').each(function(){
            $(this).prop('checked',false);
        });
    }
})

$('.edit').on('change', function(){
    $('.edit').each(function(){
        if($(this).is(":checked")){
            $('.all-edit').prop('checked',true);
        }else{
            $('.all-edit').prop('checked',false);
            return false;
        }
    })
})

// all delete select
$('.all-delete').on('change', function(){
    if($('.all-delete').is(":checked")){
        $('.delete-privilege').each(function(){
            $(this).prop('checked',true);
        });
    }else{
        $('.delete-privilege').each(function(){
            $(this).prop('checked',false);
        });
    }
})

$('.delete-privilege').on('change', function(){
    $('.delete-privilege').each(function(){
        if($(this).is(":checked")){
            $('.all-delete').prop('checked',true);
        }else{
            $('.all-delete').prop('checked',false);
            return false;
        }
    })
})

// all status select 
$('.all-status').on('change', function(){
    if($('.all-status').is(":checked")){
        $('.status').each(function(){
            $(this).prop('checked',true);
        });
    }else{
        $('.status').each(function(){
            $(this).prop('checked',false);
        });
    }
})

$('.status').on('change', function(){
    $('.status').each(function(){
        if($(this).is(":checked")){
            $('.all-status').prop('checked',true);
        }else{
            $('.all-status').prop('checked',false);
            return false;
        }
    })
})

// all other select 
$('.all-other').on('change', function(){
    if($('.all-other').is(":checked")){
        $('.other').each(function(){
            $(this).prop('checked',true);
        });
    }else{
        $('.other').each(function(){
            $(this).prop('checked',false);
        });
    }
})

$('.other').on('change', function(){
    $('.other').each(function(){
        if($(this).is(":checked")){
            $('.all-other').prop('checked',true);
        }else{
            $('.all-other').prop('checked',false);
            return false;
        }
    })
})

// Select All

$('.select_all').on('change', function(){
    if($('.select_all').is(":checked")){
        $('.ccheckbox').each(function(){
            $(this).prop('checked',true);
        });
    }else{
        $('.ccheckbox').each(function(){
            $(this).prop('checked',false);
        });
    }
})
