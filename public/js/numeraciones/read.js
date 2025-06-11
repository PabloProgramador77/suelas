jQuery.noConflict();
jQuery(document).ready(function(){

    $("#actualizar").attr('disabled', true);

    $(".editar").on('click', function(e){

        e.preventDefault();

        $("#numeracionEditar").val('');
        $("#descripcionEditar").val('');
        $("#idNumeracion").val('');

        var id = $(this).attr('data-value').split(',')[0];
        var numeracion = $(this).attr('data-value').split(',')[1];
        var descripcion = $(this).attr('data-value').split(',')[2];

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

            $("#numeracionEditar").val( nombre );
            $("#descripcionEditar").val( descripcion );
            $("#idNumeracion").val( id );

            $("#actualizar").attr('disabled', false);

        }

    });

});