

dataTable('#table-modality', {
    ajax:'/account/receive',
    columns: [
        {data: 'date'},
        {data: 'name'},
        {data: 'category'},
        {data: 'method'},
        {data: 'status'},
        {data: 'value'},
        {data: 'amount'},
        {data: 'pay_date'},
    ]
})