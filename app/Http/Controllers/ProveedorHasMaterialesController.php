<?php

namespace App\Http\Controllers;

use App\Models\ProveedorHasMateriales;
use Illuminate\Http\Request;

class ProveedorHasMaterialesController extends Controller
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
    public function store(Request $request, $idMaterial)
    {
        try {
            
            $proveedorHasMateriales = ProveedorHasMateriales::create([
                'idProveedor' => $request->proveedor,
                'idMaterial' => $idMaterial,
            ]);

            if( $proveedorHasMateriales && $proveedorHasMateriales->id ){
                
                return true;

            }

        } catch (\Throwable $th) {
            
            return false;

        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ProveedorHasMateriales $proveedorHasMateriales)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ProveedorHasMateriales $proveedorHasMateriales)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            
            $proveedorHasMateriales = ProveedorHasMateriales::where('idProveedor', '=', $request->idProveedor)
                                    ->where('idMaterial', '=', $request->id)
                                    ->first();

            if( $proveedorHasMateriales && $proveedorHasMateriales->id ){
                
                $proveedorHasMateriales->idProveedor = $request->proveedor;
                $proveedorHasMateriales->save();

                return true;

            }else{

                return false;

            }

        } catch (\Throwable $th) {
            
            return false;

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProveedorHasMateriales $proveedorHasMateriales)
    {
        //
    }
}
