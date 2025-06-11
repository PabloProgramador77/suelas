<?php

namespace App\Http\Controllers;

use App\Models\Numeracion;
use Illuminate\Http\Request;
use App\Http\Requests\Numeracion\Create;
use App\Http\Requests\Numeracion\Update;
use App\Http\Requests\Numeracion\Delete;

class NumeracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            
            $numeraciones = Numeracion::orderBy('created_at')->get();

            return view('numeraciones.index', compact('numeraciones'));

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
            
            $numeracion = Numeracion::create([

                'numeracion' => $request->numeracion,
                'descripcion' => $request->descripcion,

            ]);

            if( $numeracion && $numeracion->id ){

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
     * Display the specified resource.
     */
    public function show(Numeracion $numeracion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Numeracion $numeracion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request)
    {
        try {
            
            $numeracion = Numeracion::where('id', '=', $request->id)
                        ->update([

                            'numeracion' => $request->numeracion,
                            'descripcion' => $request->descripcion,

                        ]);

            if( $numeracion ){

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
     * Remove the specified resource from storage.
     */
    public function destroy(Delete $request)
    {
        try {
            
            $numeracion = Numeracion::find( $request->id );

            if( $numeracion && $numeracion->id ){

                $numeracion->delete();

                $datos['exito'] = true;

            }

        } catch (\Throwable $th) {
            
            $datos['exito'] = false;
            $datos['mensaje'] = $th->getMessage();

        }finally{

            return response()->json( $datos );
            
        }
    }
}
