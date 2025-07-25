jQuery.noConflict();
jQuery(document).ready(function(){

    $("#registrar").on('click', function(e){

        e.preventDefault();

        let procesamiento;
        const csrfToken = $('meta[name="csrf-token"]').attr('content');
        var suelas = [];
        var numeraciones = [];

        $(".pares").each( function(){

            if( $(this).val() !== "0" && $(this).val() !== null && $(this).val() !== '' ){

                let idSuela = $(this).attr('data-id');
                let idNumeracion = $(this).attr('id');
                let precio = parseFloat( $(this).attr('data-value') );
                let pares = parseInt( $(this).val() );

                if( !isNaN( pares ) && pares > 0 ){

                    if( !suelas[idSuela] ){

                        suelas[idSuela] = {
                            'suela': idSuela,
                            'pares': 0,
                            'precio': precio,

                        }

                    }

                    suelas[idSuela].pares += pares;

                    numeraciones.push({

                        'suela' : $(this).attr('data-id'),
                        'pares' : $(this).val(),
                        'numeracion' : $(this).attr('id'),
                        'precio' : $(this).attr('data-value'),

                    });

                }

            }

        });

        let suelasArray = Object.values( suelas );

        console.log( suelas );
        console.log( numeraciones );

        Swal.fire({

            title: 'Registrando pedido',
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
                    url: '/pedido/agregar',
                    data:{

                        'suelas' : suelasArray,
                        'numeraciones' : numeraciones,
                        'cliente' : $("#cliente").val(),
                        'entrega' : $("#entrega").val(),
                        'lote' : $("#lote").val(),
                        'observaciones' : $("#observaciones").val(),
                        '_token' : csrfToken,

                    },
                    dataType: 'json',
                    encode: true

                }).done(function(respuesta){

                    if( respuesta.exito ){

                        Swal.fire({

                            icon: 'success',
                            title: 'Pedido registrado',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            timer: 999,
                            timerProgressBar: true

                        }).then((resultado)=>{
                            
                            if( resultado.dismiss == Swal.DismissReason.timer ){

                                window.location.href = '/pedidos';

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

                                window.location.href = '/pedidos';

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

                        window.location.href = '/pedidos';

                    }

                });

            }

        });

    });
    
});