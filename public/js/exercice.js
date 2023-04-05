

dataTable('#table-exercice', {
    ajax:'/exercice',
    columns: [
        {data: 'id'},
        {data: 'name'},
        {data: 'type'},
        {data: 'created_at'},
    ]
})