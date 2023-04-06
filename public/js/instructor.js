

dataTable('#table-instructor', {
    ajax:'/instructor',
    columns: [
        {data: 'id'},
        {data: 'name'},
        {data: 'phone_wpp'},
        {data: 'created_at'},
    ]
})


dataTable('#table-instructor-modality',{})