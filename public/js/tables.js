$(document).ready(function () {
    $('#dtBasicExample').DataTable({
        "paging": true,
        "searching": true,
        "scrollY": "400px",
        "scrollX": "400px",
        "aaSorting": [],
        columnDefs: [
            {
                orderable: true,
                targets: 3
            }
        ],
        "language": {
            "lengthMenu": "Mostrar _MENU_ registros",
            "zeroRecords": "No se encontraron resultados",
            "info": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
            "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
            "infoFiltered": "(filtrado de un total de _MAX_ registros)",
            "sSearch": "Buscar:",
            "oPaginate": {
                "sFirst": "Primero",
                "sLast": "Último",
                "sNext": "Siguiente",
                "sPrevious": "Anterior"
            },
            "sProcessing": "Procesando..."
        }
    });
    $('.dataTables_length').addClass('bs-select');
});