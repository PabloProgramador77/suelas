<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;
use App\Http\Requests\Material\Create;
use App\Http\Requests\Material\Update;
use App\Http\Requests\Material\Delete;
use App\Models\Proveedor;
use App\Http\Controllers\ProveedorHasMaterialesController;

class MaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {

            $materiales = Material::all();
            $proveedores = Proveedor::all();

            return view('materiales.index', compact('materiales', 'proveedores'));

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
            
            $material = Material::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'precio' => $request->precio,
                'unidad' => $request->unidad,
            ]);

            if( $material && $material->id ){

                $proveedorHasMateriales = new ProveedorHasMaterialesController();
                $datos['exito'] = $proveedorHasMateriales->store($request, $material->id);

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
    public function show(Material $material)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Material $material)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request)
    {
        try {
            
            $material = Material::where('id', '=', $request->id)
                        ->update([

                            'nombre' => $request->nombre,
                            'descripcion' => $request->descripcion,
                            'precio' => $request->precio,
                            'unidad' => $request->unidad,
                        
                        ]);

            if( $material ){

                $proveedorHasMateriales = new ProveedorHasMaterialesController();
                $datos['exito'] = $proveedorHasMateriales->update($request);

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
            
            $material = Material::find( $request->id );

            if( $material && $material->id ){

                $material->delete();

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
