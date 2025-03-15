jQuery.noConflict();
jQuery(document).ready(function(){

    $("#actualizar").attr('disabled', true);

    $(".editar").on('click', function(e){

        e.preventDefault();

        $("#nombreEditar").val('');
        $("#precioEditar").val('');
        $("#descripcionEditar").val('');
        $("#unidadEditar").val('');
        $("#idMaterial").val('');

        var id = $(this).attr('data-value').split(',')[0];
        var nombre = $(this).attr('data-value').split(',')[1];
        var precio = $(this).attr('data-value').split(',')[2];
        var descripcion = $(this).attr('data-value').split(',')[3];
        var unidad = $(this).attr('data-value').split(',')[4];

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

            if ($("#unidadEditar option[value='"+unidad+"']").length === 0) {

                $("#unidadEditar").find('option[value="'+unidad+'"]').remove(); 
                $("#unidadEditar").prepend('<option value="'+unidad+'">'+unidad+'</option>');
            
            }

            $("#nombreEditar").val( nombre );
            $("#precioEditar").val( precio );
            $("#descripcionEditar").val( descripcion );
            $("#idMaterial").val( id );

            $("#actualizar").attr('disabled', false);

        }

    });

});