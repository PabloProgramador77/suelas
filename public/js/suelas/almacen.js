jQuery.noConflict();
jQuery(document).ready(function(){

    $("#salidaSuela").on('click', function(e){

        e.preventDefault();

        let procesamiento;
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        var salida = [];
        var numeraciones = [];

        $(".pares").each( function(){

            if( $(this).val() !== "0" && $(this).val() !== null && $(this).val() !== '' ){

                let idSuela = $(this).attr('data-id');
                let idNumeracion = $(this).attr('id');
                let precio = parseFloat( $(this).attr('data-value') );
                let pares = parseInt( $(this).val() );

                if( !isNaN( pares ) && pares > 0 ){

                    salida.push({

                        'suela' : $(this).attr('data-id'),
                        'pares' : $(this).val(),
                        'numeracion' : $(this).attr('id'),
                        'precio' : $(this).attr('data-value'),

                    });

                    numeraciones.push({

                        'suela' : $(this).attr('data-id'),
                        'pares' : $(this).val(),
                        'numeracion' : $(this).attr('id'),
                        'precio' : $(this).attr('data-value'),

                    });

                }

            }

        });

        let salidaArray = Object.values( salida );

        console.log( salida );

        Swal.fire({

            title: 'Registrando salida',
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
                    url: '/almacen/salida',
                    data:{

                        'suelas' : salidaArray,
                        'numeraciones' : numeraciones,
                        'cliente' : $("#cliente").val(),
                        'entrega' : $("#entrega").val(),
                        'observaciones' : $("#observaciones").val(),
                        'lote': $("#lote").val(),
                        '_token' : csrfToken,

                    },
                    dataType: 'json',
                    encode: true

                }).done(function(respuesta){

                    if( respuesta.exito ){

                        Swal.fire({

                            icon: 'success',
                            title: 'Salida registrada',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            timer: 999,
                            timerProgressBar: true

                        }).then((resultado)=>{
                            
                            if( resultado.dismiss == Swal.DismissReason.timer ){

                                window.location.href = '/almacen';

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

                                window.location.href = '/almacen';

                            }

                        });

                    }

                });

            },
            willClose: ()=>{

                clearInterval(procesamiento);

            }

        }).then((resultado)=>{

            if( resultado.dismiss == Swal.DismissReason.timer ){

                Swal.fire({

                    icon: 'warning',
                    title: 'Hubo un inconveniente. Trata de nuevo.',
                    allowOutsideClick: false,
                    showConfirmButton: true

                }).then((resultado)=>{

                    if( resultado.isConfirmed ){

                        window.location.href = '/almacen';

                    }

                });

            }

        });

    });
    
});