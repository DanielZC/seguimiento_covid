$(document).ready(function () {
    $('#buscar-fecha_programacion').on('click',function (e) { 
        
        e.preventDefault();

        let numero_documento = $('#numero_documento-modal').val()
        let url = $('#URL_buscar-programacion').val()

        $('#buscar-fecha_programacion').attr('hidden',true)
        $('#spinner-buscar-modal').attr('hidden', false)  

        $.ajax({
            type: 'POST',
            url: url,
            data: {numero_documento},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                
                $('#buscar-fecha_programacion').attr('hidden',false)
                $('#spinner-buscar-modal').attr('hidden', true)
                
                console.log(response)
                switch (response.status) {
                    case 'ok':
                        $('small[name="err"]').attr('hidden', true)
                            response.data.forEach(element => {
                                console.log(element);
                                $('#nombrePaciente-modal').text(
                                    `Nombre: ${element.primer_nombre} ${element.primer_apellido} ${element.segundo_apellido}`
                                )
                                $('#documentoPaciente-modal').text(
                                    `Documento de identificacion: ${element.tipo_documento} ${element.numero_documento}`
                                )
                                $('#edadPaciente-modal').text(
                                    `Edad: ${element.edad} ${element.unidad_medida}`
                                )
                                $('#fecha_programacionModal').val(element.fecha_programacion)
                                $('#fecha_realizacion').attr('min',element.fecha_programacion)
                                $('#paciente_id-modal').val(element.id_paciente)
                            });

                            $('#div-form-modal').attr('hidden',false)
                        break
                    case 'existFR':
                        response.data.forEach(element => {
                            toastr.info(
                                `El paciente ${element.primer_nombre} ${element.primer_apellido} ${element.segundo_apellido} ya se lea realizado una toma de muestra`,
                                'Mensaje',
                                {
                                    timeOut: 5000,
                                    preventDuplicates: true
                                }
                            )
                        })
                        break;
                    case 'error':
                            for (const key in response.error) {
                                if (response.error.hasOwnProperty(key)) {
                                    const error = response.error[key];
                                    let docElement = `#err-${key}-modal`
                                    $(docElement).text(error)
                                    $(docElement).attr('hidden', false)
                                }
                            }
                            $('#form-fechaRealizacion').attr('hidden',true)
                        break;
                }
            }
        });
    });

    $('#guardar-fechaRealizacion').on('click',function (e) {
        
        let url = $('#URL_ingresar-fecha_realizacion').val()
        let fecha_realizacion = $('#fecha_realizacion').val()
        let visita_exitosa = $('#visita_exitosa').val()
        let tipo_prueba = $('#tipo_prueba').val()
        let observacion = $('#observacion').val()
        let motivo = $('#motivo-modal').val()
        let paciente_id = $('#paciente_id-modal').val()

        let datos = {
            fecha_realizacion,
            visita_exitosa,
            tipo_prueba,
            observacion,
            motivo,
            paciente_id
        }

        $.ajax({
            type: "PUT",
            url: url,
            data: datos,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response);
                switch (response.status) {
                    case 'ok':
                        $('small[name="err-form"]').attr('hidden', true)
                        $('#form-fechaRealizacion')[0].reset()
                        $('#div-form-modal').attr('hidden',true)

                        toastr.success(
                            `Datos guardados con exito`,
                            'Exito',
                            {
                                timeOut: 5000,
                                preventDuplicates: true
                            }
                        )

                        break
                    case 'bad':
                        toastr.error(
                            `Ha ocurrido un error al intentar guardarlos datos`,
                            'Error',
                            {
                                timeOut: 5000,
                                preventDuplicates: true
                            }
                        )
                        break
                    case 'error':
                            $('small[name="err-form"]').attr('hidden', true)
                            for (const key in response.error) {
                                if (response.error.hasOwnProperty(key)) {
                                    const error = response.error[key];
                                    let docElement = `#err-${key}-modal`
                                    $(docElement).text(error)
                                    $(docElement).attr('hidden', false)
                                }
                            }
                        break;
                }
            }
        });
    })
});