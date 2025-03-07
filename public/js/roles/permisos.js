jQuery.noConflict();
jQuery(document).ready(function(){

    var permisos = new Array();

    $("#permitir").on('click', function(e){

        e.preventDefault();

        let procesamiento;
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        $("input[name=permiso]:checked").each(function(){

            permisos.push($(this).val());

        });

        Swal.fire({

            title: 'Agregando Permisos',
            html: 'Un momento por favor: <b></b>',
            timer: 9975,
            allowOutsideClick: false,
            didOpen: ()=>{

                Swal.showLoading();
                const b = Swal.getHtmlContainer().querySelector('b');
                procesamiento = setInterval(()=>{

                    b.textContent = Swal.getTimerLeft();

                }, 100);

                $.ajax({

                    type: 'POST',
                    url: '/role/permisos',
                    data:{

                        'id' : $("#idRolePermiso").val(),
                        'permisos' : permisos,
                        '_token' : csrfToken,

                    },
                    dataType: 'json',
                    encode: true

                }).done(function(respuesta){

                    if( respuesta.exito ){

                        Swal.fire({

                            icon: 'success',
                            title: 'Permisos Agregados',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            timer: 1999,
                            timerProgressBar: true,

                        }).then((resultado)=>{

                            if( resultado.dismiss == Swal.DismissReason.timer ){

                                window.location.href = '/roles';

                            }

                        });

                    }else{

                        Swal.fire({

                            icon: 'error',
                            title: respuesta.mensaje,
                            allowOutsideClick: false,
                            showConfirmButton: true

                        }).then((resultado)=>{

                            if( resultado.isConfirmed ){

                                window.location.href = '/roles';

                            }

                        });

                    }

                });

            },
            willClose: ()=>{

                clearInterval(procesamiento);

            }

        }).then(function(resultado){

            if( resultado.dismiss == Swal.DismissReason.timer ){

                Swal.fire({

                    icon: 'warning',
                    title: 'Hubo un inconveniente. Trata de nuevo.',
                    allowOutsideClick: false,
                    showConfirmButton: true

                }).then((resultado)=>{

                    if( resultado.isConfirmed ){

                        window.location.href = '/roles';

                    }

                });

            }
            
        });

    });

});