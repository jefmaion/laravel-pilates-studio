

dataTable('#table-registrations', {
    ajax:'/registration',
    pageLength: 10,
    columns: [
        {data: 'name'},
        {data: 'modality'},
        {data: 'duration'},
        {data: 'value'},
        {data: 'end'},
        {data: 'classes'},
        {data: 'status'},
    ],
    columnDefs: [
        { className: 'text-center', targets: [2,3,4,5] }
    ],
})


dataTable('.datatable', {pageLength: 10})


// $('[name="check-list-active"]').change(function (e) { 
//     e.preventDefault();
//     filterActiveRegistrations($(this).prop('checked'))
// });


function filterActiveRegistrations(obj) {

    table = $('#table-registrations').DataTable();

    url = '/registration'
    
    if($(obj).prop('checked')) {
        url  = url + '?active=1'
    }

    table.ajax.url(url).load();
}