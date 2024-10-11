var base_url = $('#base_url').val();
$(function (){
    var table = $("#arm_data_table").DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/subscriber-data-table",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
            },
            {
                data: "email",
                name: "email",
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