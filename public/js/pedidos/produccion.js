jQuery.noConflict();
jQuery(document).ready(function(){

    $(".produccion, .terminado, .cerrar").on('click', function(e){

        e.preventDefault();

        let procesamiento;
        
        var id = $(this).attr('data-value');
        var estado = $(this).attr('data-estado');

        console.log( estado );

        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({

            title: 'Actualizando pedido',
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
                    url: '/pedido/produccion',
                    data:{

                        'id' : id,
                        'estado' : estado,
                        '_token' : csrfToken,

                    },
                    dataType: 'json',
                    encode: true

                }).done(function(respuesta){

                    if( respuesta.exito ){

                        Swal.fire({

                            icon: 'success',
                            title: 'Actualizado',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            timer: 999,
                            timerProgressBar: true,

                        }).then((resultado)=>{

                            if( resultado.dismiss == Swal.DismissReason.timer ){

                                switch( estado ){

                                    case 'Produccion':
                                        window.open('http://suelas.dev/pdf/orden'+id+'.pdf', '_blank');
                                        setTimeout( window.location.href = '/pedidos', 999);
                                        break;

                                    case 'Terminado':
                                        window.open('http://suelas.dev/pdf/terminacion'+id+'.pdf', '_blank');
                                        setTimeout( window.location.href = '/pedidos', 999);
                                        break;

                                    default:
                                        window.location.href = '/pedidos';
                                        break;
                                }
                                
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