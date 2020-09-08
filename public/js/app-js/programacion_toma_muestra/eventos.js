$(document).ready(function () {
    $('#visita_exitosa').on('change', function () {  
        if(this.value == 'No'){
            $('#form-group-motivo').attr('hidden', false)
            $('#form-group-tipo_prueba').attr('hidden', true)
            $('#form-group-observacion').attr('hidden', true)
        }else{
            $('#form-group-motivo').attr('hidden', true)   
            $('#form-group-tipo_prueba').attr('hidden',false)
            $('#form-group-observacion').attr('hidden',false)

        }
    })

    $('#close-modal-fr').on('click', function(){
        $('small[name="err-form"]').attr('hidden', true)
        $('#form-fechaRealizacion')[0].reset()
        $('#modal-buscar-fr')[0].reset()
        $('#div-form-modal').attr('hidden',true)
    })
});