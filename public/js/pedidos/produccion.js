jQuery.noConflict();
jQuery(document).ready(function(){

    $(".producir, .terminado, .cerrar").on('click', function(e){

        e.preventDefault();

        let procesamiento;
        
        var id = $(this).attr('data-value').split(',')[0];
        var estado = $(this).attr('data-value').split(',')[1];

        console.log( estado );

        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        Swal.fire({

            title: 'Imprimiendo documento de producción',
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
                            title: 'Documento listo',
                            allowOutsideClick: false,
                            showConfirmButton: false,
                            timer: 999,
                            timerProgressBar: true,

                        }).then((resultado)=>{

                            if( resultado.dismiss == Swal.DismissReason.timer && estado === 'Produccion' ){

                                window.open('http://suelas.dev/pdf/orden'+id+'.pdf', '_blank');

                            }else{

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