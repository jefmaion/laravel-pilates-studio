

dataTable('.datatable', {
    ajax:'/student',
    columns: [
        {data: 'id'},
        {data: 'name'},
        {data: 'phone_wpp'},
        {data: 'created_at'},
        {data: 'has_registration'},
    ]
})