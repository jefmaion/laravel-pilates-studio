

dataTable('#table-registrations', {
    ajax:'/registration',
    pageLength: 10,
    columns: [
        {data: 'name'},
        {data: 'modality'},
        {data: 'end'},
        {data: 'status'},
    ]
})


dataTable('.datatable', {pageLength: 5})


$('[name="check-list-active"]').change(function (e) { 
    e.preventDefault();

    url = $(this).val()
    
    if($(this).prop('checked')) {
        url  = url + '?active=1'
    }

    table = $('#table-registrations').DataTable();
    table.ajax.url(url).load();
});

function loadDataTable() {
    
}