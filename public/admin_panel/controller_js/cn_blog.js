var base_url = $('#base_url').val();

$(function () {
    var table = $("#arm_data_table").DataTable({
        processing: true,
        serverSide: true,
        
        ajax: {
            url : base_url + "/admin/blog-data-table",
            data: function (d) {
                d.page_type = $('#page_type').val()
            }
        },
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
            },

            {
                data: "title",
                name: "title",
            },
            {
                data: "type",
                name: "type",
            },
            {
                data: "description",
                name: "description",
            },

            {
                data: "published_on",
                name: "published_on",
            },
            {
                data: "image_path",
                name: "image_path",
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

    $("#page_type").change(function(){
        table.draw();
    });

    function reload_table() {
        table.DataTable().ajax.reload(null, false);
    }
});