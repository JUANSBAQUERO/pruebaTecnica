$(function() {
    'use strict';

    let table = $('#table').DataTable({
        dom: 'Bfrtip',
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
				},
                extend: "csv",
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
        buttons: ['excel', 'csv', {
            text: 'Text',
            action: function ( e, dt, node, config ) {
                exportTableToTxt(dt);
            }
        }],
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

    
    function exportTableToTxt(dataTable) {
        let ultimoElemento;
        let data = dataTable.data().toArray();
        let headersRow = $('.table-headers').toArray()[0];
        let headers = $(headersRow).find('th').map(function () {
            return $(this).text();
        }).get();
        headers.pop();    
        for (let i = 0; i < data.length; i++) {
            ultimoElemento = data[i].pop();
        }
        let txtData = data.map(row => row.join('\t')).join('\n');
        let blob = new Blob([txtData], { type: 'text/plain' });
        let url = URL.createObjectURL(blob);
        let a = document.createElement('a');
        a.href = url;
        a.download = 'Reporte_usuarios.txt';
        a.style.display = 'none';
        document.body.appendChild(a);
        a.click();
        window.URL.revokeObjectURL(url);

        for (let i = 0; i < data.length; i++) {
            data[i].push(ultimoElemento);
        }
    }
});
