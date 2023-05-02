var config = {}


config.datatable = {
    // order: [],
    pageLength: 10,
    ordering: false,
    lengthMenu: [
        [5,10, 25, 50, -1],
        [5,10, 25, 50, 'Tudo'],
    ],
    columnDefs: [
        { className: "align-middle", targets: "_all" },
    ],
    language: {
        url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
    },
    deferRender:true,
    processing:true,
    responsive:true,
    pagingType: $(window).width() < 768 ? 'simple' : 'simple_numbers',
    
}


config.fullcalendar = {
    header: {
        left: 'prev,next today',
        center: 'title',
        right: 'month,agendaWeek,agendaDay'
    },
    navLinks:true,
    height: 'auto',
    defaultView: 'agendaWeek',
    editable: true,
    selectable: true,
    allDaySlot: false,
    displayEventTime : false,
    minTime: "07:00:00",
    maxTime: "21:00:00",
    slotDuration: '00:60:00',
    // eventLimit: true,
    nowIndicator:true,
    timeFormat: 'H(:mm)',
    slotEventOverlap:false,
    hiddenDays: [0],
    slotLabelFormat: [
        'HH:mm', // top level of text
    ]

}



function dataTable(container, config) {
    return $(container).DataTable( { 
        ...{
            order: [],
            pageLength: 10,
            lengthMenu: [
                [5,10, 25, 50, -1],
                [5,10, 25, 50, 'Tudo'],
            ],
            columnDefs: [
                { className: "align-middle", targets: "_all" },
            ],
            language: {
                url: 'https://cdn.datatables.net/plug-ins/1.13.1/i18n/pt-BR.json'
            },
            deferRender:true,
            processing:true,
            responsive:true,
            pagingType: $(window).width() < 768 ? 'simple' : 'simple_numbers',
    
    },
     ...config});
}