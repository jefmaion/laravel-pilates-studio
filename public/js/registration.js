

dataTable('#table-registrations', {
    ajax:'/registration',
    pageLength: 10,
    columns: [
        {data: 'name'},
        {data: 'modality'},
        {data: 'end'},
        {data: 'created_at'},
        {data: 'status'},
    ]
})


dataTable('.datatable', {pageLength: 5})