<?php

namespace App\Http\Controllers;

use App\Models\SalidaHasSuelas;
use Illuminate\Http\Request;
use App\Http\Controllers\AlmacenHasSuelasController;
use App\Http\Controllers\PedidoController;

class SalidaHasSuelasController extends Controller
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
            
            foreach( $request->suelas as $suela ){

                SalidaHasSuelas::create([

                    'idSuela' => $suela['suela'],
                    'idNumeracion' => $suela['numeracion'],
                    'cantidad' => $suela['pares'],

                ]);

            }

            $almacenHasSuelasCtrl = new AlmacenHasSuelasController();
            
            if( $almacenHasSuelasCtrl->create( $request ) ){

                $pedidoCtrl = new PedidoController();

                if( $pedidoCtrl->update( $request ) ){

                    $datos['exito'] = true;

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
     * Display the specified resource.
     */
    public function show(SalidaHasSuelas $salidaHasSuelas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SalidaHasSuelas $salidaHasSuelas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SalidaHasSuelas $salidaHasSuelas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SalidaHasSuelas $salidaHasSuelas)
    {
        //
    }
}
