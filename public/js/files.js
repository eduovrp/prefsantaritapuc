$(document).ready(function() {
    $('#dataTable-Files').DataTable({
        pageLength: 15,
        responsive: true,
        "paging": true,
        "order": [[ 0, "desc" ]],
        dom: '<"html5buttons"B>lTfgitp',
        buttons: [
            {extend: 'copy', text: 'Copiar'},
            {extend: 'excel', title: 'Tabela',
            exportOptions: {
                    columns: ':visible.print'
                },
            },
            {extend: 'pdf', title: 'Tabela',
            exportOptions: {
                    columns: ':visible.print'
                },
            },
        ]

    });

    $('input[name="files"]').fileuploader({
        addMore: true
    });


} );
