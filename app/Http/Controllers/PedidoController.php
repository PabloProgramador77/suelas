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
use App\Http\Controllers\PedidoHasNumeracionesController;
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
            $pares = 0;

            foreach( $request->numeraciones as $numeracion){

                $total += floatval( $numeracion['pares'] * $numeracion['precio'] );
                $pares += intval( $numeracion['pares'] );

            }

            $pedido = Pedido::create([

                'idCliente' => $request->cliente,
                'total' => $total,
                'estado' => 'Pendiente',
                'observaciones' => $request->observaciones,
                'fecha_entrega' => $request->entrega,
                'lote' => $request->lote,

            ]);

            if( count( $request->suelas ) > 0 && $pedido->id ){

                $pedidoHasSuelaCtrl = new PedidoHasSuelaController();

                if( $pedidoHasSuelaCtrl->store( $request, $pedido->id ) ){

                    $pedidoHasNumeracionesCtrl = new PedidoHasNumeracionesController();

                    if( $pedidoHasNumeracionesCtrl->store( $request, $pedido->id )){

                        $clienteCtrl = new ClienteController();

                        $datos['exito'] = $clienteCtrl->create( $request, $total );

                    }else{

                        $datos['exito'] = false;
                        $datos['mensaje'] = 'Numeraciones no registradas';
                        
                    }

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
    public function edit(Request $request)
    {
        try {

            $pedido = Pedido::where('id', '=', $request->id)
                    ->update([

                        'estado' => ucfirst( $request->estado ),

                    ]);

            if( $pedido ){

                switch( $request->estado ){

                    case "Produccion":
                        $this->orden( $request->id );
                        break;
                    
                    case "Terminado":
                        $this->terminado( $request->id );
                        break;

                }

                $datos['exito'] = true;

            }
            
        } catch (\Throwable $th) {
            
            $datos['exito'] = false;
            $datos['mensaje'] = $th->getMessage();

        }finally{

            return response()->json( $datos );

        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
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
                    <body style="height: 50%; max-height: 50%;">
                        <div style="width: 100%; height: auto; padding: 5px; display: block; overflow: auto;">
                            <div style="width: 100%; height: auto; display: block; overflow: auto; margin: 0 auto; text-align: center;">
                                <h4 style="text-align: right; width: 100%; display: inline-block; margin-top: 0px; float: left;">NOTA DE REMISIÓN: '.$pedido->id.'</h4>
                            </div>
                            <div style="width: 19.5%; height: auto;  overflow: hidden; display: inline-block; float: left;">
                                <img src="img/suelas_torred-removebg-preview.png" width="200px" height="auto" style="display: inline-block; float: left;">
                            </div>
                            <div style="width: 39.5%; height: auto; display: inline-block; float:left; overflow: hidden; padding-top: 10px;">
                                <table style="witdh: 100%; height: auto; overflow: auto;">
                                    <tr>
                                        <td style="font-size: 10px;"><b>Cliente:</b></td>
                                        <td style="font-size: 10px;">'.$pedido->cliente->nombre.'</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 10px;"><b>Fecha de pedido:</b></td>
                                        <td style="font-size: 10px;">'.$pedido->updated_at.'</td>
                                    </tr>
                                </table>
                            </div>
                            <div style="width: 39.5%; height: auto; display: inline-block; float: left; overflow: hidden; padding-top: 10px;">
                                <table style="witdh: 100%; height: auto; overflow: auto;">
                                    <tr>
                                        <td style="font-size: 10px;"><b>Suela:</b></td>
                                        <td style="font-size: 10px;">Con marca/ Sin marca</td>
                                    </tr>
                                    <tr>
                                        <td style="font-size: 10px;"><b>Fecha de entrega:</b></td>
                                        <td style="font-size: 10px;">'.$pedido->fecha_entrega.'</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div style="width: 100%; height: auto; overflow: auto; display: block;">
                            <table style="width: 100%; height: auto; overflow: auto; border-collapse: collapse;">
                                <tr style="background-color: #3498DB;">
                                    <td style="font-size: 10px; text-align: center; height: auto; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Suela</b></td>
                                    <td style="font-size: 10px; text-align: center; height: auto; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Descripción</b></td>
                                    <td style="font-size: 10px; text-align: center; height: auto; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Color</b></td>
                                    <td style="font-size: 10px; text-align: center; height: auto; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Corrida</b></td>
                                    <td style="font-size: 10px; text-align: center; height: auto; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Pares</b></td>
                                    <td style="font-size: 10px; text-align: center; height: auto; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Importe</b></td></tr>';

                                    foreach( $pedido->suelas as $suela ){

                                        $html .= '<tr style="width: 100%; height: auto; overflow:auto; margin: 0 auto; border-bottom: 2px solid black; padding: 5px;">
                                        <td style="width: 16.6%; height: auto; font-size: 10px; text-align: center; margin: 0 auto;"><b>'.$suela->nombre.'</b></td>
                                        <td style="width: 16.6%; height: auto; font-size: 10px; text-align: center; margin: 0 auto;"><b>'.$suela->descripcion.'</b></td>
                                        <td style="width: 16.6%; height: auto; font-size: 10px; text-align: center; margin: 0 auto;"><b>'.$suela->color.'</b></td>
                                        <td style="width: 16.6%; height: auto; font-size: 10px; text-align: center; margin: 0 auto;"><b>'.$suela->corrida.'</b></td>
                                        <td style="width: 16.6%; height: auto; font-size: 10px; text-align: center; margin: 0 auto;"><b>'.$suela->pivot->pares.'</b></td>
                                        <td style="width: 16.6%; height: auto; font-size: 10px; text-align: center; margin: 0 auto;"><b>$'.$suela->pivot->importe.'</b></td></tr>';

                                        $pares += $suela->pivot->pares;
                                        
                                    }

                                $html.= '
                                <tr>
                                    <td colspan="4" style="font-size: 10px; text-align: right; border-bottom: 1px solid #7B7D7D; border-top: 1px solid #7B7D7D;"><b>Total de Pares:</b></td>
                                    <td  style="font-size: 10px; border-bottom: 1px solid #7B7D7D; border-top: 1px solid #7B7D7D; text-align: center;">'.$pares.'</td>
                                    <td  style="font-size: 10px; border-bottom: 1px solid #7B7D7D; border-top: 1px solid #7B7D7D; text-align: center; color: #3498db">$ '.number_format( $pedido->total, 2).'</td>
                                </tr>';

                                $html .='
                            </table>
                        </div>
                        <div style="width: 100%;">
                            <img src="img/pagare.jpeg" style="width: 100%; height: auto; display: block; margin: auto;">
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
                                <img src="img/suelas_torred-removebg-preview.png" width="200px" height="auto" style="display: inline-block; float: left;">
                                <h3 style="text-align: right; width: 100%; display: inline-block; margin-top: 0px; float: left;">ORDEN DE PRODUCCIÓN</h3>
                            </div>
                        </div>
                        <div style="width: 100%; height: auto; display: inline-block; float: left; overflow: hidden;">
                            <p style="font-size: 14px; display: block;"><b>Datos de Orden</b></p>
                            <table style="height: auto; overflow: auto;">
                                <tr>
                                    <td style="font-size: 12px; padding-left: 10px; padding-top: 5px;"><b>Cliente:</b></td>
                                    <td style="font-size: 12px; padding-left: 10px; padding-top: 5px;">'.$pedido->cliente->nombre.'</td>
                                    <td style="font-size: 12px; padding-left: 10px; padding-top: 5px;"><b>Fecha de emisión:</b></td>
                                    <td style="font-size: 12px; padding-left: 10px; padding-top: 5px;">'.$pedido->updated_at.'</td>
                                    <td style="font-size: 12px; padding-left: 10px; padding-top: 5px;"><b>N° de Pedido:</b></td>
                                    <td style="font-size: 12px; padding-left: 10px; padding-top: 5px;">'.$pedido->cliente->id.$pedido->id.'</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 12px; padding-left: 10px; padding-top: 5px;"><b>Observaciones:</b></td>
                                    <td style="font-size: 12px; padding-left: 10px; padding-top: 5px;">'.($pedido->observaciones ? $pedido->observaciones : 'Sin observaciones').'</td>
                                    <td style="font-size: 12px; padding-left: 10px; padding-top: 5px;"><b>Lote:</b></td>
                                    <td style="font-size: 12px; padding-left: 10px; padding-top: 5px;">'.$pedido->lote.'</td>
                                </tr>
                            </table>
                        </div>
                        <div style="width: 100%; height: auto; overflow: auto; display: block; margin-top: 20px; margin-bottom: 20px;">
                            <table style="width: 100%; height: auto; overflow: auto; border-collapse: collapse;">
                                <tr style="background-color: #3498DB;">
                                    <td style="font-size: 14px; text-align: center; padding: 20px; height: 20px; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Modelo</b></td>
                                    <td style="font-size: 14px; text-align: center; padding: 20px; height: 20px; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Color</b></td>
                                    <td style="font-size: 14px; text-align: center; padding: 20px; height: 20px; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Corrida</b></td>
                                    <td style="font-size: 14px; text-align: center; padding: 20px; height: 20px; color: white; border-top: 2px solid #424949; border-bottom: 2px solid #424949; border-left: 1px solid #FDFEFE;"><b>Total</b></td></tr>';

                                    foreach( $pedido->suelas as $suela ){

                                        $html .= '<tr style="width: 100%; height: auto; overflow:auto; margin: 0 auto; padding: 5px;">
                                        <td style="width: 20%; height: auto; font-size: 14px; text-align: center; padding-top: 10px; margin: 0 auto; border-bottom: 1px solid black;"><b>'.$suela->nombre.'</b></td>
                                        <td style="width: 50%; height: auto; font-size: 14px; text-align: center; padding-top: 10px; margin: 0 auto; border-bottom: 1px solid black;"><b>'.$suela->color.'</b></td>';

                                        $numeracionesHtml='';

                                        foreach( $suela->numeraciones as $numeracion ){

                                            $cantidad = $suela->paresNumeraciones()->wherePivot( 'idPedido', $pedido->id )->where('idNumeracion', $numeracion->id)->first()->pivot->cantidad;
                                            
                                            $numeracionesHtml.= '<b>#'.$numeracion->numeracion.'</b>/'.$cantidad.' ';

                                        }

                                        $html.='<td style="width: 50%; height: auto; font-size: 14px; text-align: center; padding-top: 10px; margin: 0 auto; border-bottom: 1px solid black;">'.$numeracionesHtml.'</td>
                                        <td style="width: 50%; height: auto; font-size: 14px; text-align: center; padding-top: 10px; margin: 0 auto; border-bottom: 1px solid black;"><b>'.$suela->pivot->pares.'</b></td>
                                        </tr>';
                                        
                                    }

                                $html.= '
                                
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

    /**
     * Documento de terminado
     */
    public function terminado( $idPedido ){
        try{

            $pedido = Pedido::find( $idPedido );
            
            $html = '';

            if( $pedido->id ){

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

                $html.='
                <html>
                    <head></head>
                    <body>';

                foreach( $pedido->suelas as $suela ){

                    $html.='
                    <table style="width: 100%; height: auto; padding: 10px; border: 1px solid black; margin-top: 5px; margin-bottom: 5px;">
                            <tr>
                                <td style="font-size: 13px;"><b>Fecha de tarjeta: </b><u>'.$pedido->updated_at.'</u></td>
                                <td style="font-size: 13px;"><b>Fecha de pedido: </b><u>'.$pedido->created_at.'</u></td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;"><b>Folio: </b><u>'.$pedido->id.'</u></td>
                                <td style="font-size: 13px;"><b>Lote: </b><u>'.$pedido->lote.'</u></td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;"><b>Cliente: </b><u>'.$pedido->cliente->nombre.'</u></td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;"><b>Modelo de suela: </b><u>'.$suela->nombre.'</u></td>
                                <td style="font-size: 13px;"><b>Color: </b><u>'.$suela->color.'</u></td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;"><b>Pares: </b><u>'.$suela->pivot->pares.'</u></td>
                                <td style="font-size: 13px;"><b>Linea: </b><u>'.$suela->descripcion.' '.$suela->corrid.' '.$suela->marca.'</u></td>
                            </tr>
                            <tr>';

                                $numeraciones = '';

                                foreach( $suela->numeraciones as $numeracion ){

                                    $numeraciones.='<b>#'.$numeracion->numeracion.'</b>/'.$suela->paresNumeraciones()->wherePivot( 'idPedido', $pedido->id )->where('idNumeracion', $numeracion->id)->first()->pivot->cantidad.' ';

                                }

                                $html.='
                                <td style="font-size: 13px;"><b>Numeración: </b><u>'.$numeraciones.'</u></td>
                            </tr>
                            <tr>
                                <td style="font-size: 13px;"><b>Prensista: </b>_________________________________</td>
                                <td style="font-size: 13px;"><b>Rebabeadora: </b>_________________________________</td>
                            </tr>
                        </table>';

                }

                
                $html.='
                    </body>
                </html>';

                $pdf->writeHTML( $html );

                unset( $html );

                $pdf->Output( public_path('pdf/').'terminacion'.$idPedido.'.pdf', \Mpdf\Output\Destination::FILE );

                if( file_exists( public_path('pdf/').'terminacion'.$idPedido.'.pdf' ) ){

                    return true;

                }else{

                    return false;

                }

            }

        }catch(\Throwable $th){

            return false;

        }
    }
}
