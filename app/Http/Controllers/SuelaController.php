<?php

namespace App\Http\Controllers;

use App\Models\Suela;
use Illuminate\Http\Request;
use App\Http\Requests\Suela\Create;
use App\Http\Requests\Suela\Update;
use App\Http\Requests\Suela\Delete;

class SuelaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            
            $suelas = Suela::all();

            return view('suelas.index', compact('suelas'));

        } catch (\Throwable $th) {
            //throw $th;
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
            
            $suela = Suela::create([
                
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'color' => $request->color,
                'corrida' => $request->corrida,
                'marca' => $request->marca,
            
            ]);

            if( $suela && $suela->id ) {

                $datos['exito'] = true;

            }

        } catch (\Throwable $th) {
            
            $datos['exito'] = false;
            $datos['mensaje'] = $th->getMessage();

        } finally {

            return response()->json($datos);

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Suela $suela)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Suela $suela)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request)
    {
        try {
        
            $suela = Suela::where('id', '=', $request->id)->update([
                
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'color' => $request->color,
                'corrida' => $request->corrida,
                'marca' => $request->marca,
            
            ]);

            if( $suela ) {

                $datos['exito'] = true;

            }

        } catch (\Throwable $th) {
            
            $datos['exito'] = false;
            $datos['mensaje'] = $th->getMessage();

        } finally {

            return response()->json($datos);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delete $request)
    {
        try {
            
            $suela = Suela::find( $request->id );

            if( $suela ) {

                $suela->delete();

                $datos['exito'] = true;

            }

        } catch (\Throwable $th) {
            
            $datos['exito'] = false;
            $datos['mensaje'] = $th->getMessage();

        } finally {

            return response()->json($datos);
            
        }
    }
}
