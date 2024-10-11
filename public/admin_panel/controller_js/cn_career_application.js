


var base_url = $('#base_url').val();
$(function () {
    var table = $("#arm_data_table").DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/career-application-data-table",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
            },
            {
                data: "application_for",
                name: "application_for",
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
                data: "email",
                name: "email",
            },

            {
                data: "phone",
                name: "phone",
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
                data: "file_path",
                name: "file_path",
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