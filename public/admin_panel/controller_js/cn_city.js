// Client Side form validation
$(document).ready(function () {
    $("#city_form").validate({
        rules: {
            country_id: {
                required : true,
            },
            state_id: {
                required: true,
            },
            city_name: {
                required: true,
                remote: {
                    url: base_url + "/admin/city-exists",
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
                        city_name: function () {
                            return $("#city_name").val();
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
            city_name: {
                required: "*Enter city name",
                remote: "* This city already exists under this country and state",
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});

// datatable data

$(function () {
    var table = $('#city_table').DataTable({
        processing: true,
        serverSide: true,

        ajax: base_url + "/admin/city-data-table",
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

function deleteCity(city_id)
{
    var id = city_id;
    var actionDiv = $(this);
    if (confirm("Do you really want to delete this city ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id},
            url: base_url + "/admin/delete-city",
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
                    var oTable = $("#city_table").dataTable();
                    success_toast("Success", data.message);
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#city_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
}


function CityStatusChange(city_id)
{
    var id = city_id;
    var actionDiv = $(this);
    if (confirm("Do you really want to change status ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id},
            url: base_url + "/admin/change-city-status",
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
                    var oTable = $("#city_table").dataTable();
                    success_toast("Success", data.message);
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#city_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
}
