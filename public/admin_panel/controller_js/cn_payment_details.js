var base_url = $('#base_url').val();
$(function () {
    var table = $("#arm_data_table").DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/payment-details-data-table",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
            },
            {
                data: "created_at",
                name: "created_at",
            },

            {
                data: "report_name",
                name: "report_name",
            },
            {
                data: "user_name",
                name: "user_name",
            },

            {
                data: "user_email",
                name: "user_email",
            },

            {
                data: "user_mobile",
                name: "user_mobile",
            },

            {
                data: "payment_method",
                name: "payment_method",
            },

            {
                data: "payment_status",
                name: "payment_status",
            },

            {
                data: "payment_id",
                name: "payment_id",
            },

            {
                data: "report_price",
                name: "report_price",
            },

            {
                data: "license_type",
                name: "license_type",
            },
            {
                data: "created_ip_address",
                name: "created_ip_address",
            },

            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    function reload_table() {
        table.DataTable().ajax.reload(null, false);
    }
});

new DataTable('#arm_data_table', {
    scrollX: true
});

