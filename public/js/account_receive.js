

dataTable('#table-modality', {
    ajax:'/account/receive',
    columns: [
        {data: 'id'},
        {data: 'date'},
        {data: 'value'},
        {data: 'name'},
       
        {data: 'method'},
        {data: 'status'},
        {data: 'created_at'},
    ]
})