jQuery.noConflict();
jQuery(document).ready(function(){

    $("#actualizar").attr('disabled', true);

    $(".editar").on('click', function(e){

        e.preventDefault();

        $("#nombreEditar").val('');
        $("#idPermiso").val('');

        var id = $(this).attr('data-value').split(',')[0];
        var nombre = $(this).attr('data-value').split(',')[1];

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
            $("#idPermiso").val( id );

            $("#actualizar").attr('disabled', false);

        }

    });

});