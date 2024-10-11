$(document).ready(function () {
    $("#country_form").validate({
        rules: {
            country_name: {
                required: true,
                remote: {
                    url:  base_url + "/admin/country-exists",
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
                        country_name: function () {
                            return $("#country_name").val();
                        },
                    },
                },
            },
        },
        messages: {
            country_name: {
                required: "*Enter country name",
                remote: "* This country already exists.",
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});

$(function () {
    var table = $('#countries_table').DataTable({
        processing: true,
        serverSide: true,

        ajax: base_url + "/admin/country-data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'country_name',
            name: 'country_name'
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

function deleteCountry(country_id)
{
    var id = country_id;
    var actionDiv = $(this);
    if (confirm("Do you really want to delete this country ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id},
            url: base_url + "/admin/delete-country",
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
                    var oTable = $("#countries_table").dataTable();
                    success_toast("Success", data.message);
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#countries_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
}


function CountryStatusChange(country_id)
{
    var id = country_id;
    var actionDiv = $(this);
    if (confirm("Do you really want to change status ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id},
            url: base_url + "/admin/change-country-status",
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
                    var oTable = $("#countries_table").dataTable();
                    success_toast("Success", data.message);
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#countries_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
}
