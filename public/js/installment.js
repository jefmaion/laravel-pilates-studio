

dataTable('#table-modality', {
    ajax:'/installment',
    columns: [
        {data: 'status'},
        {data: 'date'},
        
        {data: 'name'},
        {data: 'modality'},
        {data: 'value'},
        {data: 'created_at'},
    ]
})