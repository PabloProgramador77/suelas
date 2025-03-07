<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\Permission\Create;
use App\Http\Requests\Permission\Update;
use App\Http\Requests\Permission\Delete;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            
            $permisos = Permission::all();
            
            return view('usuarios.permisos.index', compact('permisos'));

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
            
            $permiso = Permission::create([
                
                'name' => $request->nombre

            ]);

            if( $permiso && $permiso->id ){

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
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Update $request)
    {
        try {
            
            $permiso = Permission::where('id', '=', $request->id)
                ->update([
                    
                    'name' => $request->nombre

                ]);

            if( $permiso ){

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

            $permiso = Permission::find($request->id);

            if( $permiso && $permiso->id ){

                $permiso->delete();

                $datos['exito'] = true;

            }

        } catch (\Throwable $th) {
            
            $datos['exito'] = false;
            $datos['mensaje'] = $th->getMessage();

        }

        return response()->json($datos);
    }
}
