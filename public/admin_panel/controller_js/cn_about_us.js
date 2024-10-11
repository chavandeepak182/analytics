var base_url = $('#base_url').val();
$(function () {
    var table = $("#arm_data_table").DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + "/admin/why-us-content-data-table",
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
            },
            {
                data: "content_image_path",
                name: "content_image_path",
            },

            {
                data: "content_title",
                name: "content_title",
            },
            {
                data: "content_description",
                name: "content_description",
            },

           

            {
                data: "status",
                name: "status",
                orderable: false,
                searchable: false,
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