// Client Side form validation
$(document).ready(function () {
    $("#pincode_form").validate({
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
            area_id: {
                required : true,
            },
            pincode: {
                required: true,
                remote: {
                    url: base_url + "/admin/pincode-exists",
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
                        pincode: function () {
                            return $("#pincode").val();
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
            area_id: {
                required: "*Select a area",
            },
            pincode: {
                required: "*Enter pincode",
                remote: "*Pincode already exists.",
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});

// datatable data

$(function () {
    var table = $('#pincode_table').DataTable({
        processing: true,
        serverSide: true,

        ajax: base_url + "/admin/pincode-data-table",
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
            data: 'pincode',
            name: 'pincode'
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

function deletePincode(pincode_id)
{
    var id = pincode_id;
    var actionDiv = $(this);
    if (confirm("Do you really want to delete this pincode ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id},
            url: base_url + "/admin/delete-pincode",
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
                    var oTable = $("#pincode_table").dataTable();
                    success_toast("Success", data.message);
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#pincode_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
}


function PincodeStatusChange(pincode_id)
{
    var id = pincode_id;
    var actionDiv = $(this);
    if (confirm("Do you really want to change status ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id},
            url: base_url + "/admin/change-pincode-status",
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
                    var oTable = $("#pincode_table").dataTable();
                    success_toast("Success", data.message);
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#pincode_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
}
