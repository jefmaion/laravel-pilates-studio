

dataTable('#table-modality', {
    ajax:'/account/receive',
    columns: [
        {data: 'status'},
        {data: 'date'},
        {data: 'pay_date'},
        
        {data: 'name'},
       
        {data: 'category'},
        {data: 'method'},
        {data: 'value'},
        {data: 'amount'},
        
        {data: 'created_at'},
    ]
})