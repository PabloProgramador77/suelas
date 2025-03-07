jQuery.noConflict();
jQuery(document).ready(function(){

    $("#actualizar").attr('disabled', true);

    $(".editar").on('click', function(e){

        e.preventDefault();

        $("#nombreEditar").val('');
        $("#idUsuario").val('');

        var id = $(this).attr('data-value').split(',')[0];
        var nombre = $(this).attr('data-value').split(',')[1];
        var email = $(this).attr('data-value').split(',')[2];
        var rol = $(this).attr('data-value').split(',')[3];

        console.log( rol );

        if( id === null || id === '' ){

            $("#actualizar").attr('disabled', true);

            Swal.fire({

                icon: 'error',
                title: 'Error de lectura',
                allowOutsideClick: false,
                showConfirmButton: true,

            });

            $("#actualizar").attr('disabled', true);

        }else{

            $("#nombreEditar").val( nombre );
            $("#idUsuario").val( id );
            $("#emailEditar").val( email );

            if ($("#roleEditar option[value='"+rol+"']").length === 0) {
                $("#roleEditar").find('option[value="'+rol+'"]').remove(); // Eliminar la opción que coincide con rol
                $("#roleEditar").prepend('<option value="'+rol+'">'+rol+'</option>');
            }
            
            $("#roleEditar").val(rol);

            $("#actualizar").attr('disabled', false);

        }

    });

});