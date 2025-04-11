<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Suela;
use App\Models\Cliente;
use Illuminate\Http\Request;
use App\Http\Requests\Pedido\Create;
use App\Http\Requests\Pedido\Delete;
use App\Http\Requests\Pedido\Read;
use App\Http\Controllers\PedidoHasSuelaController;
use App\Http\Controllers\ClienteController;
use Mpdf\Mpdf;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            
            $pedidos = Pedido::orderBy('created_at', 'desc')->get();
            $suelas = Suela::all();
            $clientes = Cliente::all();

            return view('pedidos.index', compact('pedidos', 'suelas', 'clientes'));

        } catch (\Throwable $th) {
            
            echo $th->getMessage();

        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create( Request $request )
    {
        try {
            
            $this->pdf( $request->id );
            $this->orden( $request->id );

            if( file_exists( public_path('pdf/').'nota'.$request->id.'.pdf') && file_exists( public_path('pdf/').'orden'.$request->id.'.pdf' ) ){
                
                $datos['exito'] = true;

            }else{

                $datos['exito'] = false;
                $datos['mensaje'] = 'Documento(s) no encontrado.';

            }

        } catch (\Throwable $th) {
            
            $datos['exito'] = false;
            $datos['mensaje'] = $th->getMessage();

        }

        return response()->json( $datos );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Create $request)
    {
        try {
            
            $total = 0;

            foreach( $request->suelas as $suela){

                $total += floatval( $suela['pares'] * $suela['precio'] );

            }

            $pedido = Pedido::create([

                'idCliente' => $request->cliente,
                'total' => $total,
                'estado' => 'Pendiente',
                'observaciones' => $request->observaciones,

            ]);

            if( count( $request->suelas ) > 0 && $pedido->id ){

                $pedidoHasSuelaCtrl = new PedidoHasSuelaController();
                if( $pedidoHasSuelaCtrl->store( $request, $pedido->id ) ){

                    $clienteCtrl = new ClienteController();
                    $datos['exito'] = $clienteCtrl->create( $request, $total );

                }else{

                    $datos['exito'] = false;
                    $datos['mensaje'] = 'Pedido incompleto';

                }

            }

        } catch (\Throwable $th) {
            
            $datos['exito'] = false;
            $datos['mensaje'] = $th->getMessage();

        } finally{

            return response()->json( $datos );
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Read $request)
    {
        try {
            
            $pedido = Pedido::find( $request->id );

            if( $pedido && $pedido->id ){

                $datos['exito'] = true;
                $datos['suelas'] = $pedido->suelas;

            }

        } catch (\Throwable $th) {
            
            $datos['exito'] = false;
            $datos['mensaje'] = $th->getMessage();

        }finally{

            return response()->json( $datos );
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delete $request)
    {
        try {
            
            $pedido = Pedido::find( $request->id );

            if( $pedido && $pedido->id ){

                $clienteCtrl = new ClienteController();
                
                if( $clienteCtrl->edit( $pedido ) ){

                    $pedido->delete();

                    $datos['exito'] = true;

                }else{

                    $datos['exito'] = false;
                    $datos['mensaje'] = 'Actualización de saldo incompleta';

                }

            }

        } catch (\Throwable $th) {
            
            $datos['exito'] = false;
            $datos['mensaje'] = $th->getMessage();

        }finally{

            return response()->json( $datos );

        }

    }

    /**
     * Creación de PDF de nota
     */
    public function pdf( $idPedido ){
        try {
            
            $pedido = Pedido::find( $idPedido );
            
            $html = '';

            if( $pedido->id ){

                $pares = 0;

                $pdf = new \Mpdf\Mpdf([

                    'mode' => 'utf-8',
                    'format' => 'A4',
                    'orientation' => 'P',
                    'autoPageBreak' => false,
                    'margin_left' => 10,
                    'margin_right' => 10,
                    'margin_top' => 10,
                    'margin_bottom' => 10,

                ]);

                $html .='
                    <html>
                    <head>
                        <style>
                        </style>
                    </head>
                    <body>
                        <div style="width: 100%; height: auto; padding: 5px; display: block; overflow: auto;">
                            <div style="width: 100%; height: auto; display: block; overflow: auto; margin: 0 auto; text-align: center;">
                                <img src="img/logo-removebg-preview.png" width="100px" height="auto" style="display: inline-block; float: left;">
                                <h3 style="text-align: right; width: 100%; display: inline-block; margin-top: 0px; float: left;">NOTA DE VENTA</h3>
                            </div>
                        </div>
                        <div style="width: 49.4%; height: auto; display: inline-block; float: left; overflow: hidden;">
                            <p style="font-size: 12px; display: block;"><b>Datos de Nota</b></p>
                            <table style="witdh: 100%; height: auto; overflow: auto;">
                                <tr>
                                    <td style="font-size: 11px;"><b>N° de nota:</b></td>
                                    <td style="font-size: 11px;">'.$pedido->id.'</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 11px;"><b>Fecha de emisión:</b></td>
                                    <td style="font-size: 11px;">'.$pedido->updated_at.'</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 11px;"><b>Vendedor:</b></td>
                                    <td style="font-size: 11px;">'.auth()->user()->name.'</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 11px;"><b>Observaciones:</b></td>
                                    <td style="font-size: 11px;">'.($pedido->observaciones ? $pedido->observaciones : 'Sin observaciones').'</td>
                                </tr>
                            </table>
                        </div>
                        <div style="width: 49.4%; height: auto; display: inline-block; float: left; overflow: hidden;">
                            <p style="font-size: 12px; display: block;"><b>Datos de Cliente</b></p>
                            <table style="witdh: 100%; height: auto; overflow: auto;">
                                <tr>
                                    <td style="font-size: 11px;"><b>Nombre:</b></td>
                                    <td style="font-size: 11px;">'.$pedido->cliente->nombre.'</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 11px;"><b>Domicilio:</b></td>
                                    <td style="font-size: 11px;">'.($pedido->cliente->direccion ? $pedido->cliente->direccion : 'Sin domicilio registrado').'</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 11px;"><b>Telefono:</b></td>
                                    <td style="font-size: 11px;">'.($pedido->cliente->telefono ? $pedido->cliente->telefono : 'Sin telefono registrado').'</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 11px;"><b>Correo:</b></td>
                                    <td style="font-size: 11px;">'.($pedido->cliente->email ? $pedido->cliente->email : 'Sin email registrado').'</td>
                                </tr>
                            </table>
                        </div>
                        <div style="width: 100%; height: auto; overflow: auto; display: block; margin-top: 40px;">
                            <table style="width: 100%; height: auto; overflow: auto; border-collapse: collapse;">
                                <tr style="background-color: #3498DB;">
                                    <td style="font-size: 12px; text-align: center; padding: 20px; height: 40px; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Suela</b></td>
                                    <td style="font-size: 12px; text-align: center; padding: 20px; height: 40px; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Precio</b></td>
                                    <td style="font-size: 12px; text-align: center; padding: 20px; height: 40px; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Descripción</b></td>
                                    <td style="font-size: 12px; text-align: center; padding: 20px; height: 40px; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Color</b></td>
                                    <td style="font-size: 12px; text-align: center; padding: 20px; height: 40px; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Corrida</b></td>
                                    <td style="font-size: 12px; text-align: center; padding: 20px; height: 40px; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Pares</b></td>
                                    <td style="font-size: 12px; text-align: center; padding: 20px; height: 40px; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Importe</b></td></tr>';

                                    foreach( $pedido->suelas as $suela ){

                                        $html .= '<tr style="width: 100%; height: auto; overflow:auto; margin: 0 auto; border-bottom: 2px solid black; padding: 5px;">
                                        <td style="width: 14.2%; height: auto; font-size: 12px; text-align: center; padding-top: 10px; margin: 0 auto;"><b>'.$suela->nombre.'</b></td>
                                        <td style="width: 14.2%; height: auto; font-size: 12px; text-align: center; padding-top: 10px; margin: 0 auto;"><b>$'.$suela->precio.'</b></td>
                                        <td style="width: 14.2%; height: auto; font-size: 12px; text-align: center; padding-top: 10px; margin: 0 auto;"><b>'.$suela->descripcion.'</b></td>
                                        <td style="width: 14.2%; height: auto; font-size: 12px; text-align: center; padding-top: 10px; margin: 0 auto;"><b>'.$suela->color.'</b></td>
                                        <td style="width: 14.2%; height: auto; font-size: 12px; text-align: center; padding-top: 10px; margin: 0 auto;"><b>'.$suela->corrida.'</b></td>
                                        <td style="width: 14.2%; height: auto; font-size: 12px; text-align: center; padding-top: 10px; margin: 0 auto;"><b>'.$suela->pivot->pares.'</b></td>
                                        <td style="width: 14.2%; height: auto; font-size: 12px; text-align: center; padding-top: 10px; margin: 0 auto;"><b>$'.$suela->pivot->importe.'</b></td></tr>';

                                        $pares += $suela->pivot->pares;
                                        
                                    }

                                $html.= '
                                <tr style="padding: 10px;">
                                    <td colspan="4" style="font-size: 12px; text-align: right; border-bottom: 1px solid #7B7D7D; border-top: 1px solid #7B7D7D;"><b>Total de Pares:</b></td>
                                    <td  style="font-size: 12px; border-bottom: 1px solid #7B7D7D; border-top: 1px solid #7B7D7D; text-align: center;">'.$pares.'</td>
                                    <td  style="font-size: 12px; text-align: right; border-bottom: 1px solid #7B7D7D; border-top: 1px solid #7B7D7D;"><b>Subtotal:</b></td>
                                    <td  style="font-size: 12px; border-bottom: 1px solid #7B7D7D; border-top: 1px solid #7B7D7D; text-align: center;">$ '.number_format( $pedido->total, 2).'</td>
                                </tr>';

                                
                                $html .='
                                <tr>
                                    <td colspan="5" style="font-size: 12px; text-align: right; color: #3894DB; padding: 5px;"><b>TOTAL:</b></td>
                                    <td style="font-size: 12px; border-bottom: 2px solid black; color: #3894DB; padding: 5px;"><b>$ '.number_format( $pedido->total, 2).'</b></td>
                                </tr>
                                <tr>
                                    <td colspan="5" style="font-size: 12px; text-align: right; padding: 5px;"><b>ANTICIPO:</b></td>
                                    <td style="font-size: 12px; border-bottom: 2px solid black; padding: 5px;">$ '.number_format(($pedido->total/2), 2).'</td>
                                </tr>
                            </table>
                        </div>
                    </body>
                    </html>
                ';

                $pdf->writeHTML( $html );

                unset( $html );

                $pdf->Output( public_path('pdf/').'nota'.$idPedido.'.pdf', \Mpdf\Output\Destination::FILE );

                if( file_exists( public_path('pdf/').'nota'.$idPedido.'.pdf' ) ){

                    return true;

                }else{

                    return false;

                }

            }else{

                return false;

            }

        } catch (\Throwable $th) {
            
            echo $th->getMessage();
            return false;

        }
    }

    /**
     * Creación de orden de trabajo
     */
    public function orden( $idPedido ){
        try {
            
            $pedido = Pedido::find( $idPedido );
            
            $html = '';

            if( $pedido->id ){

                $pares = 0;

                $pdf = new \Mpdf\Mpdf([

                    'mode' => 'utf-8',
                    'format' => 'A4',
                    'orientation' => 'P',
                    'autoPageBreak' => false,
                    'margin_left' => 10,
                    'margin_right' => 10,
                    'margin_top' => 10,
                    'margin_bottom' => 10,

                ]);

                $html .='
                    <html>
                    <head>
                        <style>
                        </style>
                    </head>
                    <body>
                        <div style="width: 100%; height: auto; padding: 5px; display: block; overflow: auto;">
                            <div style="width: 100%; height: auto; display: block; overflow: auto; margin: 0 auto; text-align: center;">
                                <img src="img/logo-removebg-preview.png" width="100px" height="auto" style="display: inline-block; float: left;">
                                <h3 style="text-align: right; width: 100%; display: inline-block; margin-top: 0px; float: left;">ORDEN DE PRODUCCIÓN</h3>
                            </div>
                        </div>
                        <div style="width: 49.4%; height: auto; display: inline-block; float: left; overflow: hidden;">
                            <p style="font-size: 12px; display: block;"><b>Datos de Nota</b></p>
                            <table style="witdh: 100%; height: auto; overflow: auto;">
                                <tr>
                                    <td style="font-size: 11px;"><b>Folio de producción:</b></td>
                                    <td style="font-size: 11px;">'.$pedido->id.'</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 11px;"><b>Fecha de emisión:</b></td>
                                    <td style="font-size: 11px;">'.$pedido->updated_at.'</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 11px;"><b>Vendedor:</b></td>
                                    <td style="font-size: 11px;">'.auth()->user()->name.'</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 11px;"><b>Observaciones:</b></td>
                                    <td style="font-size: 11px;">'.($pedido->observaciones ? $pedido->observaciones : 'Sin observaciones').'</td>
                                </tr>
                            </table>
                        </div>
                        <div style="width: 49.4%; height: auto; display: inline-block; float: left; overflow: hidden;">
                            <p style="font-size: 12px; display: block;"><b>Datos de Cliente</b></p>
                            <table style="witdh: 100%; height: auto; overflow: auto;">
                                <tr>
                                    <td style="font-size: 11px;"><b>Nombre:</b></td>
                                    <td style="font-size: 11px;">'.$pedido->cliente->nombre.'</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 11px;"><b>Domicilio:</b></td>
                                    <td style="font-size: 11px;">'.($pedido->cliente->direccion ? $pedido->cliente->direccion : 'Sin domicilio registrado').'</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 11px;"><b>Telefono:</b></td>
                                    <td style="font-size: 11px;">'.($pedido->cliente->telefono ? $pedido->cliente->telefono : 'Sin telefono registrado').'</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 11px;"><b>Correo:</b></td>
                                    <td style="font-size: 11px;">'.($pedido->cliente->email ? $pedido->cliente->email : 'Sin email registrado').'</td>
                                </tr>
                            </table>
                        </div>
                        <div style="width: 100%; height: auto; overflow: auto; display: block; margin-top: 40px;">
                            <table style="width: 100%; height: auto; overflow: auto; border-collapse: collapse;">
                                <tr style="background-color: #3498DB;">
                                    <td style="font-size: 12px; text-align: center; padding: 20px; height: 40px; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Suela</b></td>
                                    <td style="font-size: 12px; text-align: center; padding: 20px; height: 40px; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Descripción</b></td>
                                    <td style="font-size: 12px; text-align: center; padding: 20px; height: 40px; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Color</b></td>
                                    <td style="font-size: 12px; text-align: center; padding: 20px; height: 40px; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Corrida</b></td>
                                    <td style="font-size: 12px; text-align: center; padding: 20px; height: 40px; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Pares</b></td>';

                                    foreach( $pedido->suelas as $suela ){

                                        $html .= '<tr style="width: 100%; height: auto; overflow:auto; margin: 0 auto; padding: 5px;">
                                        <td style="width: 20%; height: auto; font-size: 12px; text-align: center; padding-top: 10px; margin: 0 auto; border-bottom: 1px solid black;"><b>'.$suela->nombre.'</b></td>
                                        <td style="width: 20%; height: auto; font-size: 12px; text-align: center; padding-top: 10px; margin: 0 auto; border-bottom: 1px solid black;"><b>'.$suela->descripcion.'</b></td>
                                        <td style="width: 20%; height: auto; font-size: 12px; text-align: center; padding-top: 10px; margin: 0 auto; border-bottom: 1px solid black;"><b>'.$suela->color.'</b></td>
                                        <td style="width: 20%; height: auto; font-size: 12px; text-align: center; padding-top: 10px; margin: 0 auto; border-bottom: 1px solid black;"><b>'.$suela->corrida.'</b></td>
                                        <td style="width: 20%; height: auto; font-size: 12px; text-align: center; padding-top: 10px; margin: 0 auto; border-bottom: 1px solid black;"><b>'.$suela->pivot->pares.'</b></td>';

                                        $pares += $suela->pivot->pares;
                                        
                                    }

                                $html.= '
                                <tr style="padding: 10px;">
                                    <td colspan="4" style="font-size: 12px; text-align: right; background-color: #7B7D7D; border-top: 1px solid #7B7D7D;"><b>Total de Pares:</b></td>
                                    <td  style="font-size: 12px; background-color: #7B7D7D; border-top: 1px solid #7B7D7D; text-align: center;">'.$pares.'</td>
                                </tr>
                            </table>
                        </div>
                    </body>
                    </html>
                ';

                $pdf->writeHTML( $html );

                unset( $html );

                $pdf->Output( public_path('pdf/').'orden'.$idPedido.'.pdf', \Mpdf\Output\Destination::FILE );

                if( file_exists( public_path('pdf/').'orden'.$idPedido.'.pdf' ) ){

                    return true;

                }else{

                    return false;

                }

            }else{

                return false;

            }

        } catch (\Throwable $th) {
            
            echo $th->getMessage();

            return false;

        }
    }
}
