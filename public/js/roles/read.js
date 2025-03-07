jQuery.noConflict();
jQuery(document).ready(function(){

    $("#actualizar").attr('disabled', true);

    $(".editar").on('click', function(e){

        e.preventDefault();

        $("#nombreEditar").val('');
        $("#idRole").val('');

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
            $("#idRole").val( id );

            $("#actualizar").attr('disabled', false);

        }

    });

    $(".permisos").on('click', function(e){

        e.preventDefault();

        $("#nombreRole").val('');
        $("#idRolePermiso").val('');


        var dataValue = $(this).attr('data-value').split(',');
        var id = dataValue[0];
        var nombre = dataValue[1];
        var permisos = JSON.parse(dataValue.slice(2).join(','));

        console.log(permisos);

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

            $("#nombreRole").val( nombre );
            $("#idRolePermiso").val( id );

            $("input[type=checkbox][id^=permiso]").prop('checked', false);

            $.each( permisos, function(i, item){

                $("#permiso" + item.id).prop('checked', true);

            });

            $("#actualizar").attr('disabled', false);

        }

    });

});