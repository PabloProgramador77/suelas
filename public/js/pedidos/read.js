jQuery.noConflict();
jQuery(document).ready(function(){

    $("#imprimir").attr('disabled', true);

    $(".ver").on('click', function(e){

        e.preventDefault();

        var id = $(this).attr('data-value').split(',')[0];
        var nombre = $(this).attr('data-value').split(',')[1];
        var total = $(this).attr('data-value').split(',')[2];
        var observaciones = $(this).attr('data-value').split(',')[3];
        var entrega = $(this).attr('data-value').split(',')[4];
        var lote = $(this).attr('data-value').split(',')[5];
        var acomodo = $(this).attr('data-value').split(',')[6];

        if( id === null || id === '' ){

            $("#actualizar").attr('disabled', true);

            Swal.fire({

                icon: 'error',
                title: 'Error de lectura',
                allowOutsideClick: false,
                showConfirmButton: true,

            });

            $("#imprimir").attr('disabled', true);

        }else{

            const csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({

                type: 'POST',
                url: '/pedido/buscar',
                data:{

                    'id' : id,
                    '_token' : csrfToken,

                },
                dataType: 'json',
                encode: true

            }).done(function(respuesta){

                if( respuesta.exito ){

                    $("#idPedidoImprimir").val( id );

                    if( respuesta.suelas.length > 0 ){

                        var html = '<thead><tr><th>Suela</th><th>Descripción</th><th>Color</th><th>Precio</th><th>Corrida</th><th>Marca</th><th>Pares</th><th>Importe</th></tr></thead>';

                        respuesta.suelas.forEach( function( suela ){

                            html += '<tr>';
                            html += '<td>'+suela.nombre+'</td>';
                            html += '<td>'+(suela.descripcion ? suela.descripcion : 'Sin descripción')+'</td>';
                            html += '<td>'+suela.color+'</td>';
                            html += '<td>$ '+suela.precio+'</td>';
                            html += '<td>'+suela.corrida+'</td>';
                            html += '<td>'+suela.marca+'</td>';
                            html += '<td>'+suela.pivot.pares+'</td>';
                            html += '<td>$ '+suela.pivot.importe+'</td>';
                            html += '</tr>';

                        });

                        $("#contenedorPedido").empty();
                        $("#contenedorPedido").append( html );
                        $("#totalPedido").empty();
                        $("#totalPedido").text('$'+total);
                        $("#clientePedido").empty();
                        $("#clientePedido").val( nombre );
                        $("#observacionesPedido").empty();
                        $("#observacionesPedido").val( observaciones );
                        $("#entregaPedido").empty();
                        $("#entregaPedido").val( entrega );
                        $("#lotePedido").empty();
                        $("#lotePedido").val( lote );
                        $("#acomodoPedido").empty();
                        $("#acomodoPedido").val( acomodo );
                        $("#imprimir").attr('disabled', false);

                    }else{

                        $("#imprimir").attr('disabled', true);

                    }

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

        }

    });

});