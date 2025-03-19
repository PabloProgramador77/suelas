jQuery.noConflict();
jQuery(document).ready(function(){

    $("#actualizar").attr('disabled', true);

    $(".editar").on('click', function(e){

        e.preventDefault();

        $("#nombreEditar").val('');
        $("#emailEditar").val('');
        $("#telefonoEditar").val('');
        $("#domicilioEditar").val('');
        $("#rfcEditar").val('');
        $("#idCliente").val('');

        var id = $(this).attr('data-value').split(',')[0];
        var nombre = $(this).attr('data-value').split(',')[1];
        var email = $(this).attr('data-value').split(',')[2];
        var telefono = $(this).attr('data-value').split(',')[3];
        var direccion = $(this).attr('data-value').split(',')[4];
        var rfc = $(this).attr('data-value').split(',')[5];

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
            $("#idCliente").val( id );
            $("#emailEditar").val( email );
            $("#telefonoEditar").val( telefono );
            $("#domicilioEditar").val( direccion );
            $("#rfcEditar").val( rfc );

            $("#actualizar").attr('disabled', false);

        }

    });

});