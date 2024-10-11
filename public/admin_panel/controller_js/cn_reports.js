var base_url = $('#base_url').val();

$(function () {
    var table = $('#arm_data_table').DataTable({
        processing: true,
        serverSide: true,
        deferRender: true,
        ajax: {
            url : base_url + "/admin/report-data-table",
            data: function (d) {
                d.fromdate = $('#fromdate').val(),
                d.todate = $('#todate').val(),
                d.category_id = $('#category_id').val()
            },
            // Custom function to handle the response format
            dataSrc: function (json) {
                console.log(json.data.data);
                return json.data.data;
            }
        },
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'report_id',
            name: 'report_id'
        },
        {
            data: 'upcoming_report',
            name: 'upcoming_report'
        },
        {
            data: 'top_selling_report',
            name: 'top_selling_report'
        },
        {
            data: 'title',
            name: 'title'
        },
        {
            data: 'category_name',
            name: 'category_name'
        },
        {
            data: 'publisher',
            name: 'publisher'
        },
        {
            data: 'url',
            name: 'url'
        },
        {
            data: 'published_on',
            name: 'published_on'
        },
        {
            data: 'related_report',
            name: 'related_report'
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

    $(".filter-btn").click(function(){
        $("#filter-form")[0].reset();
        table.draw();
    })

    $("#fromdate, #todate, #category_id").change(function(){
        table.draw();
    });

    function reload_table() {
        table.DataTable().ajax.reload(null, false);
    }
})

$(document).on("click", ".change-top-selling", function () {
    var base_url = $("#base_url").val();
    var id = $(this).data("id");
    var table = $(this).data("table");
    var flash = $(this).data("flash");
    var actionDiv = $(this);
    if (confirm("Do you really want to change top selling status ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id, table: table, flash: flash },
            url: base_url + "/admin/report/change-top-selling-report-status",
            beforeSend: function () {
                $(this).hide();
                actionDiv
                    .html(
                        "<i class='fa fa-spin fa-spinner' style='color: #0c0c0c !important;'></i>"
                    )
                    .show();
            },
            success: function (data) {
                if(data.status == 'true'){
                    var oTable = $("#arm_data_table").dataTable();
                    success_toast("Success", data.message);
                    // if (data.user_status == "yes") {
                        actionDiv.html(
                            "<i class='fa fa-check-circle text-success' aria-hidden='true' title=''></i>"
                        );
                        $("#top_selling_report_count").html(data.topSellingReportCount);
                    // } else {
                    //     actionDiv.html(
                    //         "<i class='fa fa-check-circle text-danger' aria-hidden='true' title=''></i>"
                    //     );
                    // }
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#arm_data_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
});

$(document).on("click", ".upcoming-report", function () {
    var base_url = $("#base_url").val();
    var id = $(this).data("id");
    var table = $(this).data("table");
    var flash = $(this).data("flash");
    var actionDiv = $(this);
    if (confirm("Do you really want to change upcoming report status ?")) {
        $.ajax({
            type: "post",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            data: { id: id, table: table, flash: flash },
            url: base_url + "/admin/report/change-upcoming-report-status",
            beforeSend: function () {
                $(this).hide();
                actionDiv
                    .html(
                        "<i class='fa fa-spin fa-spinner' style='color: #0c0c0c !important;'></i>"
                    )
                    .show();
            },
            success: function (data) {
                if(data.status == 'true'){
                    var oTable = $("#arm_data_table").dataTable();
                    success_toast("Success", data.message);
                    // if (data.user_status == "yes") {
                        actionDiv.html(
                            "<i class='fa fa-check-square-o text-success' aria-hidden='true' title=''></i>"
                        );
                        $("#total_upcoming_report_count").html(data.upcomingReportCount);
                    // } else {
                    //     actionDiv.html(
                    //         "<i class='fa fa-check-square-o text-danger' aria-hidden='true' title=''></i>"
                    //     );
                    // }
                    oTable.fnDraw(false);
                }else{
                    var oTable = $("#arm_data_table").dataTable();
                    fail_toast("Error", data.message);
                    oTable.fnDraw(false);
                }
            },
        });
    }
});
 
