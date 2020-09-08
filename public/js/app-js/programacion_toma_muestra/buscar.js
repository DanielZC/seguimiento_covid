$(document).ready(function () {
    $('#buscarPaciente').on('click', function(e){
        
        e.preventDefault()

        let url = $('#url_bucarPaciente').val();
        let numero_documento = $('#numero_documento').val();

        $.ajax({
            type: "POST",
            url: url,
            data: {numero_documento},
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (response) {
                console.log(response);
                
                switch (response.status) {
                    case 'ok':
                            console.log('ok');
                            response.data.data.forEach(element => {
                                $('#nombrePacienteTitulo').text(
                                    `${element.primer_nombre.toUpperCase() +' '+ element.primer_apellido.toUpperCase() +' '+ element.segundo_apellido.toUpperCase()}`
                                )
                                $('#nombrePaciente').text(
                                    `Nombre: ${element.primer_nombre.toUpperCase() +' '+ element.primer_apellido.toUpperCase() +' '+ element.segundo_apellido.toUpperCase()}`
                                )
                                $('#documentoPaciente').text(
                                    `Documento de identificacion: ${element.tipo_documento} ${element.numero_documento}`
                                )
                                $('#edadPaciente').text(
                                    `Edad: ${element.edad} ${element.unidad_medida}`
                                )
                                $('#tipoPaciente').text(
                                    `Tipo de paciente: ${element.tipo_paciente}`
                                )
                                $('#aseguradora').text(
                                    `Aseguradora: ${element.aseguradora}`
                                )

                                $('#paciente_id').val(element.id_paciente)
                            });
                            
                            $('#card-paciente').attr('hidden',false)
                            $('#div-formulario-programacion').attr('hidden',false)
                        break
                    case 'exists':
                            toastr.warning(
                                `El paciente ${response.data.data[0]} ya tiene una fecha de programacion asignada para ${response.data.data[1]}`,
                                'Advertencia',
                                {
                                    timeOut: 5000,
                                    preventDuplicates: true
                                }
                            )
                        break;
                    case '!found':
                        // let paciente = response.data.data
                        toastr.error(
                            `El numero de documento ${response.data.data} no se encuentra registrado`,
                            'Advertencia',
                            {
                                timeOut: 5000,
                                preventDuplicates: true
                            }
                        )
                        break;
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