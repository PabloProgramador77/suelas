jQuery.noConflict();
jQuery(document).ready(function(){

    $("#editar").attr('disabled', true);

    $(".editar").on('click', function(e){

        e.preventDefault();

        $("#materialEditar").val('');
        $("#cantidadEditar").val('');
        $("#descripcionMaterialEditar").val('');

        var id = $(this).attr('data-value').split(',')[0];
        var idMaterial = $(this).attr('data-value').split(',')[1];
        var material = $(this).attr('data-value').split(',')[2];
        var cantidad = $(this).attr('data-value').split(',')[3];
        var descripcion = $(this).attr('data-value').split(',')[4];

        if( id === null || id === '' ){

            $("#editar").attr('disabled', true);

            Swal.fire({

                icon: 'error',
                title: 'Error de lectura',
                allowOutsideClick: false,
                showConfirmButton: true,

            });

            $("#editar").attr('disabled', true);

        }else{

            console.log( id, idMaterial, material, cantidad, descripcion );

            $("#idMaterialSuela").val( id );

            if ($("#materialEditar option[value='"+idMaterial+"']").length === 0) {

                $("#materialEditar").find('option[value="'+idMaterial+'"]').remove(); // Eliminar la opción que coincide con rol
                $("#materialEditar").prepend('<option value="'+idMaterial+'">'+material+'</option>');

            }

            $("#cantidadEditar").val( cantidad );
            $("#descripcionMaterialEditar").val( descripcion );

            $("#editar").attr('disabled', false);

        }

    });

});