<?php

namespace App\Http\Controllers;

use App\Models\PedidoHasSuela;
use Illuminate\Http\Request;

class PedidoHasSuelaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $request, $idPedido)
    {
        try {
            
            if( count( $request->suelas ) > 0 ){

                foreach( $request->suelas as $suela ){

                    $pedidoHasSuela = PedidoHasSuela::create([

                        'idPedido' => $idPedido,
                        'idSuela' => $suela['suela'],
                        'pares' => $suela['pares'],
                        'importe' => floatval( $suela['pares'] * $suela['precio'] ),

                    ]);

                }

                return true;

            }else{

                return false;

            }

        } catch (\Throwable $th) {
            
            echo $th->getMessage();

            return false;

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(PedidoHasSuela $pedidoHasSuela)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PedidoHasSuela $pedidoHasSuela)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PedidoHasSuela $pedidoHasSuela)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PedidoHasSuela $pedidoHasSuela)
    {
        //
    }
}
