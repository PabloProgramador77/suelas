<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Http\Requests\Proveedor\Create;
use App\Http\Requests\Proveedor\Update;
use App\Http\Requests\Proveedor\Delete;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            
            $proveedores = Proveedor::all();

            return view('proveedores.index', compact('proveedores'));

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
            
            $proveedor = Proveedor::create([
                'nombre' => $request->nombre,
                'direccion' => $request->direccion,
                'telefono' => $request->telefono,
                'email' => $request->email,
            ]);

            if( $proveedor && $proveedor->id ) {

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
    public function show(Proveedor $proveedor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Proveedor $proveedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request)
    {
        try {
        
            $proveedor = Proveedor::where('id', '=', $request->id)
                        ->update([
                            'nombre' => $request->nombre,
                            'direccion' => $request->direccion,
                            'telefono' => $request->telefono,
                            'email' => $request->email,
                            'rfc' => $request->rfc,
                        ]);

            if( $proveedor ) {

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
            
            $proveedor = Proveedor::find( $request->id );

            if( $proveedor && $proveedor->id){
                
                $proveedor->delete();

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
