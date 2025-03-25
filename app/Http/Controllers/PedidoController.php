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
    public function create()
    {
        //
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
}
