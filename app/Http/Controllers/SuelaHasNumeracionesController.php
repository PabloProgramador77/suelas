<?php

namespace App\Http\Controllers;

use App\Models\SuelaHasNumeraciones;
use App\Models\Suela;
use Illuminate\Http\Request;
use App\Http\Requests\SuelaHasNumeraciones\Create;

class SuelaHasNumeracionesController extends Controller
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

            $suela= Suela::find( $request->suela );

            if( count( $suela->numeraciones ) > 0 ){

                $nums = SuelaHasNumeraciones::where('idSuela', '=', $request->suela)->get();

                foreach( $nums as $num){

                    $num->delete();
                    
                }

                foreach( $request->numeraciones as $numeracion ){

                    SuelaHasNumeraciones::create([

                        'idSuela' => $request->suela,
                        'idNumeracion' => $numeracion,

                    ]);

                }

                $datos['exito'] = true;

            }else{

                if( count( $request->numeraciones) > 0 ){

                    foreach( $request->numeraciones as $numeracion ){

                        SuelaHasNumeraciones::create([

                            'idSuela' => $request->suela,
                            'idNumeracion' => $numeracion,

                        ]);

                    }

                    $datos['exito'] = true;

                }

            }

        } catch (\Throwable $th) {
            
            $dato['exito'] = false;
            $datos['mensaje'] = $th->getMessage();

        }finally{

            return response()->json( $datos );

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SuelaHasNumeraciones $suelaHasNumeraciones)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuelaHasNumeraciones $suelaHasNumeraciones)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SuelaHasNumeraciones $suelaHasNumeraciones)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SuelaHasNumeraciones $suelaHasNumeraciones)
    {
        //
    }
}
