// Client Side form validation
$(document).ready(function () {
    $("#area_form").validate({
        rules: {
            country_id: {
                required : true,
            },
            state_id: {
                required: true,
            },
            city_id: {
                required : true,
            },
            area_name: {
                required: true,
                remote: {
                    url: base_url + "/admin/area-exists",
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
                        country_id: function () {
                            return $("#country_id").val();
                        },
                        state_id: function () {
                            return $("#state_id").val();
                        },
                        city_id: function () {
                            return $("#city_id").val();
                        },
                        area_name: function () {
                            return $("#area_name").val();
                        },
                    },
                },
            }
        },
        messages: {
            country_id: {
                required : "*Select a country.",
            },
            state_id: {
                required: "*Select a state",
            },
            city_id: {
                required: "*Select a city",
            },
            area_name: {
                required: "*Enter area name",
                remote: "* This area already exists under this country, state and city.",
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});

// datatable data

$(function () {
    var table = $('#area_table').DataTable({
        processing: true,
        serverSide: true,

        ajax: base_url + "/admin/area-data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'country_name',
            name: 'country_name'
        },
        {
            data: 'state_name',
            name: 'state_name'
        },
        {
            data: 'city_name',
            name: 'city_name'
        },
        {
            data: 'area_name',
            name: 'area_name'
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

function deleteArea(area_id)
{
    var id = area_id;
    var actionDiv = $(this);
    if (confirm("Do you really want to delete this area ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id},
            url: base_url + "/admin/delete-area",
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
                    var oTable = $("#area_table").dataTable();
                    success_toast("Success", data.message);
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#area_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
}


function AreaStatusChange(area_id)
{
    var id = area_id;
    var actionDiv = $(this);
    if (confirm("Do you really want to change status ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id},
            url: base_url + "/admin/change-area-status",
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
                    var oTable = $("#area_table").dataTable();
                    success_toast("Success", data.message);
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#area_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
}
