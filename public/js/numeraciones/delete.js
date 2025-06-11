jQuery.noConflict();
jQuery(document).ready(function(){

    $(".borrar").on('click', function(e){

        e.preventDefault();

        Swal.fire({

            icon: 'warning',
            title: '¿En verdad deseas borrar la numeración/talla '+$(this).attr('data-value').split(',')[1]+'?',
            html: 'Los datos no podrán ser recuperados de ninguna manera.',
            allowOutsideClick: false,
            confirmButtonText: 'Si, borrala',
            showConfirmButton: true,
            showDenyButton: true,

        }).then((resultado)=>{

            if( resultado.isConfirmed ){

                const csrfToken = $('meta[name="csrf-token"]').attr('content');

                $.ajax({

                    type: 'POST',
                    url: '/numeracion/borrar',
                    data:{

                        'id' : $(this).attr('data-value').split(',')[0],
                        '_token' : csrfToken,

                    },
                    dataType: 'json',
                    encode: true

                }).done(function(respuesta){

                    if( respuesta.exito ){

                        Swal.fire({

                            icon: 'success',
                            title: 'Numeracion borrada.',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            timer: 999,
                            timerProgressBar: true,

                        }).then((resultado)=>{

                            if( resultado.dismiss === Swal.DismissReason.timer ){

                                window.location.href = '/numeraciones';

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

                                window.location.href = '/numeraciones';

                            }

                        });

                    }

                });

            }

        });

    });

});