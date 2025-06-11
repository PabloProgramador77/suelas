<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Suela;
use App\Models\SuelaHasMateriales;
use App\Models\Numeracion;
use Illuminate\Http\Request;
use App\Http\Requests\SuelaHasMateriales\Create;
use App\Http\Requests\SuelaHasMateriales\Update;
use App\Http\Requests\SuelaHasMateriales\Delete;

class SuelaHasMaterialesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index( $id )
    {
        try {
            
            $suela = Suela::find($id);
            $materiales = Material::all();
            $numeraciones = Numeracion::all();

            return view('suelas.desarrollo', compact('suela', 'materiales', 'numeraciones'));

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
            
            $suelaHasMateriales = SuelaHasMateriales::create([
            
                'idSuela' => $request->suela,
                'idMaterial' => $request->material,
                'cantidad' => $request->cantidad,
                'descripcion' => $request->descripcion,
            
            ]);

            if(  $suelaHasMateriales && $suelaHasMateriales->id ){

                $datos['exito'] = true;

            }

        } catch (\Throwable $th) {
            
            $datos['exito'] = false;
            $datos['mensaje'] = $th->getMessage();

        }

        return response()->json($datos);
    }

    /**
     * Display the specified resource.
     */
    public function show(SuelaHasMateriales $suelaHasMateriales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SuelaHasMateriales $suelaHasMateriales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request)
    {
        try {
            
            $suelaHasMateriales = SuelaHasMateriales::where('id', '=', $request->id)
                                ->update([
                                
                                    'idMaterial' => $request->material,
                                    'cantidad' => $request->cantidad,
                                    'descripcion' => $request->descripcion,
                                
                                ]);

            if( $suelaHasMateriales ){

                $datos['exito'] = true;

            }

        } catch (\Throwable $th) {
            
            $datos['exito'] = false;
            $datos['mensaje'] = $th->getMessage();

        } 

        return response()->json($datos);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Delete $request)
    {
        try {
            
            $suelaHasMateriales = SuelaHasMateriales::find($request->id);

            if( $suelaHasMateriales ){

                $suelaHasMateriales->delete();

                $datos['exito'] = true;

            }

        } catch (\Throwable $th) {
            
            $datos['exito'] = false;
            $datos['mensaje'] = $th->getMessage();

        } 

        return response()->json($datos);
    }
}
