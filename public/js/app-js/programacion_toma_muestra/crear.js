$(document).ready(function () {
    $('#guardar-fecha_programacion').on('click', function(e){

        let url = $('#url_guardar-fecha_prgramacion').val()
        let paciente_id = $('#paciente_id').val()
        let acepta_visita = $('#acepta_visita').val()
        let fecha_programacion = $('#fecha_programacion').val()
        let lugar_toma = $('#lugar_toma').val()
        let nombre_programa = $('#nombre_programa').val()
        
        console.log({
            url,
            paciente_id,
            acepta_visita,
            fecha_programacion,
            lugar_toma,
            nombre_programa
        });

        $.ajax({
            type: "POST",
            url: url,
            data: {
                paciente_id,
                acepta_visita,
                fecha_programacion,
                lugar_toma,
                nombre_programa
            },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response);
                switch (response.status) {
                    case 'ok':
                        toastr.success(
                            'Fecha de programacion asignada con exito',
                            'Exito',
                            {
                                timeOut: 5000,
                                preventDuplicates: true
                            }
                        )

                        $('#div-formulario-programacion').attr('hidden', true)
                        $('#card-paciente').attr('hidden', true)
                        break
                    case 'error':
                        for (const key in response.error) {
                            if (response.error.hasOwnProperty(key)) {
                                const error = response.error[key];
                                let docElement = `#err-${key}`
                                $(docElement).text(error)
                            }
                        }
                        break;
                }
            }
        });
    })
});