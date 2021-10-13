$(document).ready(function() {
    $('#dataTable-Files').DataTable({
        pageLength: 15,
        responsive: true,
        "paging": true,
        "order": [[ 0, "desc" ]],
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy', text: 'Copiar'},
            {extend: 'excel', title: 'Arquivos da Prefeitura de Santa Rita dOeste-SP',
            exportOptions: {
                    columns: ':visible.print'
                },
            },
            {extend: 'pdf', title: 'Arquivos da Prefeitura de Santa Rita dOeste-SP',
            exportOptions: {
                    columns: ':visible.print'
                },
            },
        ]

    });

    $('#file').fileuploader({
        addMore: true
    });


} );
