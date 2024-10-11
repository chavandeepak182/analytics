$(document).ready(function () {
    $("#tax_form").validate({
        rules: {
            tax: {
                required: true,
                remote: {
                    url:  base_url + "/admin/tax-exists",
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
                        tax: function () {
                            return $("#tax").val();
                        },
                    },
                },
                digits: true,
            },
        },
        messages: {
            tax: {
                required: "*Enter tax",
                remote: "* This tax already exists.",
                digits: "*Enter only digits.",
            },
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});

$(function () {
    var table = $('#tax_table').DataTable({
        processing: true,
        serverSide: true,

        ajax: base_url + "/admin/tax-data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'cgst_tax',
            name: 'cgst_tax'
        },
        {
            data: 'sgst_tax',
            name: 'sgst_tax'
        },
        {
            data: 'igst_tax',
            name: 'igst_tax'
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

function deleteTax(tax_id)
{
    var id = tax_id;
    var actionDiv = $(this);
    if (confirm("Do you really want to delete this tax ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id},
            url: base_url + "/admin/delete-tax",
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
                    var oTable = $("#tax_table").dataTable();
                    success_toast("Success", data.message);
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#tax_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
}


function TaxStatusChange(tax_id)
{
    var id = tax_id;
    var actionDiv = $(this);
    if (confirm("Do you really want to change status ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id},
            url: base_url + "/admin/change-tax-status",
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
                    var oTable = $("#tax_table").dataTable();
                    success_toast("Success", data.message);
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#tax_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
}
