$(function () {
    var table = $('#arm_data_table').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: {
            url : base_url + "/admin/enquiry-data-table",
            data: function (d) {
                d.request_type = $('#request_type').val()
            } 
        },
        columns: [{
            data: 'DT_RowIndex',
            name: 'DT_RowIndex'
        },
        {
            data: 'request_type',
            name: 'request_type'
        },
        {
            data: 'report_title',
            name: 'report_title'
        },
        {
            data: 'created_at',
            name: 'created_at'
        },
        {
            data: 'name',
            name: 'name'
        },
        {
            data: 'email',
            name: 'email'
        },
        {
            data: 'mobile_number',
            name: 'mobile_number',
        },
        {
            data: 'company_name',
            name: 'company_name'
        },
        {
            data: 'message',
            name: 'message'
        },
        {
            data: 'created_ip_address',
            name: 'created_ip_address'
        },
        {
            data: 'action',
            name: 'action',
            orderable: false,
            searchable: false
        },
        ]
    });

    $("#request_type").change(function(){
        table.draw();
    });

    function reload_table() {
        table.DataTable().ajax.reload(null, false);
    }
})


