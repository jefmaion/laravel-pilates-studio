

dataTable('#table-registrations', {
    ajax:'/registration',
    columns: [
        {data: 'name'},
        {data: 'modality'},
        {data: 'end'},
        {data: 'created_at'},
    ]
})


dataTable('.datatable', {pageLength: 5})