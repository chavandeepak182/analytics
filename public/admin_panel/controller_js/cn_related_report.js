var base_url = $('#base_url').val();

$(function () {
    var table = $('#arm_data_table').DataTable({
        processing: true,
        serverSide: true,
        
        ajax: base_url + '/admin/report/related-report/related-report-data-table',
        columns: [{
                data: 'DT_RowIndex',
                name: 'DT_RowIndex'
            },
            {
                data: 'related_report_title',
                name: 'related_report_title'
            },
            {
                data: 'category',
                name: 'category'
            },
            {
                data: 'report_url',
                name: 'report_url'
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
            },]
    });

    function reload_table() {
        table.DataTable().ajax.reload(null, false);
    }
})



