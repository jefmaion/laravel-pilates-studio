

dataTable('#table-modality', {
    ajax:'/modality',
    columns: [
        {data: 'id'},
        {data: 'name'},
        {data: 'status'},
        {data: 'created_at'},
    ]
})