
var base_url = $('#base_url').val();
$(function () {
    var table = $("#arm_data_table").DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/contact-us-listing-data-table",
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
                data: "name",
                name: "name",
            },
            {
                data: "phone",
                name: "phone",
            },
            {
                data: "email",
                name: "email",
            },
            {
                data: "company_name",
                name: "company_name",
            },
            {
                data: "message",
                name: "message",
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