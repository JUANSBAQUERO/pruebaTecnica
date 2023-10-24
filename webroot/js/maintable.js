$(function() {
    'use strict';

    let table = $('#table').DataTable({
        responsive: true,
        language: {
            searchPlaceholder: 'Buscar...',
            sSearch: '',
            lengthMenu: '_MENU_ filas/pagina',
            buttons: {
				extend: "excel",
				exportOptions: {
					modifier: {
						page: "all"
					}
				}
			},
            paginate: {
                first: 'Primero',
                last: 'Último',
                next: 'Siguiente',
                previous: 'Anterior'
            },
        },
        lengthChange: false,
        buttons: ['excel'],
    });

    $('#search-button').on('click', function () {
        let startDate = $('#start-date').val();
        let endDate = $('#end-date').val();

        table.columns(5).search(startDate + ' - ' + endDate).draw();
    });

    $('#start-date, #end-date').on('change', function () {
        if ($('#start-date').val() === '' && $('#end-date').val() === '') {
            table.columns(5).search('').draw();
        }
    });

    table.buttons().container().appendTo('#table_wrapper .col-md-6:eq(0)');
});
