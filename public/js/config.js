var config = {}


config.datatable = {
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
    
}



function dataTable(container, config) {
    return $(container).DataTable({ ...config, ...config.datatable});
}