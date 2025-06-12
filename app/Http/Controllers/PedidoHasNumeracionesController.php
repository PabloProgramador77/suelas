<?php

namespace App\Http\Controllers;

use App\Models\PedidoHasNumeraciones;
use Illuminate\Http\Request;

class PedidoHasNumeracionesController extends Controller
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
            
            if( count( $request->numeraciones ) > 0 ){

                foreach( $request->numeraciones as $numeracion ){

                    $pedidoHasNumeraciones = PedidoHasNumeraciones::create([

                        'idPedido' => $idPedido,
                        'idSuela' => $numeracion['suela'],
                        'idNumeracion' => $numeracion['numeracion'],
                        'cantidad' => $numeracion['pares'],

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
    public function show(PedidoHasNumeraciones $pedidoHasNumeraciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PedidoHasNumeraciones $pedidoHasNumeraciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PedidoHasNumeraciones $pedidoHasNumeraciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PedidoHasNumeraciones $pedidoHasNumeraciones)
    {
        //
    }
}
