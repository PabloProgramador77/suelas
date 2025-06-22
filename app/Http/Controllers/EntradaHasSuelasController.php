<?php

namespace App\Http\Controllers;

use App\Models\EntradaHasSuelas;
use App\Models\Pedido;
use Illuminate\Http\Request;
use App\Http\Controllers\AlmacenHasSuelasController;

class EntradaHasSuelasController extends Controller
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
    public function store(Request $request)
    {
        try {
            
            $pedido = Pedido::find( $request->id );

            foreach( $pedido->suelas as $suela ){

                foreach( $suela->numeraciones as $numeracion ){

                    EntradaHasSuelas::create([

                        'idSuela' => $suela->id,
                        'idNumeracion' => $numeracion->id,
                        'cantidad' => $suela->paresNumeraciones( $pedido->id, $suela->id, $numeracion->id )->first()->pivot->cantidad,

                    ]);

                }

            }

            $almacenHasSuelasCtrl = new AlmacenHasSuelasController;
            $almacenHasSuelasCtrl->store( $request );

        } catch (\Throwable $th) {
            
            echo $th->getMessage();

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(EntradaHasSuelas $entradaHasSuelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(EntradaHasSuelas $entradaHasSuelas)
    {
        //
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
    public function destroy(EntradaHasSuelas $entradaHasSuelas)
    {
        //
    }
}
