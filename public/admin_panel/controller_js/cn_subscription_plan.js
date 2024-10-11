
$(document).ready(function () {
    $("#subscription_plan_form").validate({
        rules: {
            plan_name: {
                required: true,
                remote: {
                    url:  base_url + "/admin/subscription-plan-exists",
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
                        plan_name: function () {
                            return $("#plan_name").val();
                        },
                    },
                },
            },
            subscription_price: {
                required: true,
                digits: true,
            },
            validity_numbers: {
                required: true,
                digits: true,
            },
            validity_in: {
                required: true,
            },
            // plan_benifits: {
            //     required: true,
            // }
        },
        messages: {
            plan_name: {
                required: "*Enter plan name",
                remote: "* This plan already exists.",
            },
            subscription_price: {
                required: "*Enter plan price.",
                digits: "*Enter digits only.",
            },
            validity_numbers: {
                required: "*Enter validity number.",
                digits: "*Enter digits only.",
            },
            validity_in: {
                required: "*Enter validity unit.",
            },
            plan_benifits: {
                required: "*Enter plan benifits.",
            }
        },
        submitHandler: function (form) {
            form.submit();
        }
    });
});

$(function () {
    var table = $('#subscription_plan_table').DataTable({
        processing: true,
        serverSide: true,

        ajax: base_url + "/admin/subscription-plan-data-table",
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'plan_name',
            name: 'plan_name'
        },
        {
            data: 'subscription_price',
            name: 'subscription_price'
        },
        {
            data: 'subscription_validity',
            name: 'subscription_validity'
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

function deleteSubscriptionPlan(subscription_plan_id)
{
    var id = subscription_plan_id;
    var actionDiv = $(this);
    if (confirm("Do you really want to delete this subscription plan ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id},
            url: base_url + "/admin/delete-subscription-plan",
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
                    var oTable = $("#subscription_plan_table").dataTable();
                    success_toast("Success", data.message);
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#subscription_plan_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
}


function SubscriptionPlanStatusChange(subscription_plan_id)
{
    var id = subscription_plan_id;
    var actionDiv = $(this);
    if (confirm("Do you really want to change status ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id},
            url: base_url + "/admin/change-subscription-plan-status",
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
                    var oTable = $("#subscription_plan_table").dataTable();
                    success_toast("Success", data.message);
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#subscription_plan_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
}
